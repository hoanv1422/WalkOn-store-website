<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreContactRequest;
use App\Http\Requests\UpdateContactRequest;
use App\Mail\ContactReplyMail;
use App\Models\Contact;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    const PATH_VIEW = 'admin.contacts.';

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title = "Danh sách tin nhắn liên hệ";

        $query = Contact::with('user');

        if ($request->has('keyword')) {
            $keyword = $request->keyword;
            $query->where(function ($q) use ($keyword) {
                $q->where('contact_code', 'like', "%$keyword%")
                    ->orWhere('name', 'like', "%$keyword%")
                    ->orWhere('email', 'like', "%$keyword%")
                    ->orWhere('phone', 'like', "%$keyword%")
                    ->orWhere('message', 'like', "%$keyword%");
            });
        }
        if ($request->has('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        $contacts = $query->get();

        return view(self::PATH_VIEW . 'index', compact('contacts', 'title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'message' => 'required|string|min:5|max:1000',
        ]);

        $userId = auth()->check() ? auth()->id() : null;

        Contact::create([
            'contact_code' => 'CNT' . now()->timestamp,
            'user_id'      => $userId,
            'name'         => $request->name,
            'email'        => $request->email,
            'phone'        => $request->phone,
            'message'      => $request->message,
            'status'       => 'UNREAD',
        ]);

        return redirect()->route('contacts.index')->with('success', 'Thêm liên hệ thành công');
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateContactRequest $request, Contact $contact)
    {
        $data = $request->validated();

        // Chỉ gán responded_by khi trạng thái là REPLIED
        if ($data['status'] === 'REPLIED') {
            $data['responded_by'] = auth()->id();
        } else {
            // Nếu không phải trạng thái REPLIED thì không thay đổi người trả lời
            unset($data['responded_by']);
        }

        try {
            DB::beginTransaction();
            $contact->update($data);
            DB::commit();
            return redirect()->route('contacts.index')->with('success', 'Cập nhật trạng thái thành công');
        } catch (\Exception $exception) {
            DB::rollBack();
            return back()->with('error', 'Có lỗi khi cập nhật liên hệ');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        try {
            DB::beginTransaction();

            $contact->delete();

            DB::commit();
            return redirect()->route('contacts.index')->with('success', 'Xóa liên hệ thành công');
        } catch (\Exception $exception) {
            DB::rollBack();
            return back()->with('error', 'Lỗi khi xóa liên hệ');
        }
    }

    public function reply($id)
    {
        $contact = Contact::findOrFail($id);
        return view('admin.contacts.reply', compact('contact'));
    }
    public function sendReply(Request $request, $id)
    {
        $request->validate([
            'response_message' => 'required|string'
        ]);
        $contact = Contact::findOrFail($id);
        if ($contact->status === 'REPLIED') {
            return redirect()->route('contacts.index')
                ->with('error', 'Tin nhắn phản hồi khách hàng chỉ có thể trả lời một lần.');
        }

        try {
            Mail::to($contact->email)->send(new ContactReplyMail($contact, $request->response_message));

            $contact->update([
                'status' => 'REPLIED',
                'responded_by' => auth()->user()->id,
                'response_message' => $request->response_message
            ]);
            return redirect()->route('contacts.index')
                ->with('success', 'Đã gửi phản hồi liên hệ khách hàng thành công.');
        } catch (\Exception $e) {
            logger('Lỗi gửi email: ' . $e->getMessage());
            return redirect()->route('contacts.index')
                ->with('error', 'Đã xảy ra lỗi khi gửi phản hồi.');
        }
    }
}
