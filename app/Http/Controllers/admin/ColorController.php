<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Color;
use App\Http\Requests\StoreColorRequest;
use App\Http\Requests\UpdateColorRequest;


class ColorController extends Controller 
{
    const PATH_VIEW = 'admin.colors.';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Color::query()->latest('id')->with(['productVariant'])->paginate();
        return view(self::PATH_VIEW.__FUNCTION__,compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view(self::PATH_VIEW.__FUNCTION__);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreColorRequest $request)
    {
        $data = $request->all();
        Color::query()->create($data);
        return redirect()->route('colors.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(Color $color)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Color $color)
    {
        return view(self::PATH_VIEW.__FUNCTION__,compact('color'));  
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateColorRequest $request, Color $color)
    {
        $data=$request->all();
        $color->update($data);
        return redirect()->route('colors.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Color $color)
    {
        $color->delete();
        return redirect()->route('colors.index')->with('success','xoa thanh cong');
    }
}
