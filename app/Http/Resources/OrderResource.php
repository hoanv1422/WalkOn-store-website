<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'order_code' => $this->order_code,
            'status' => $this->order_status,
            'total_price' => $this->total_price,
            'shipping_fee' => $this->shipping_fee,
            'discount_amount' => $this->discount_amount,
            'final_price' => $this->final_price,
            'receiver_address' => $this->receiver_address,
            'receiver_phone' => $this->receiver_phone,
            'receiver_name' => $this->receiver_name,
            'payment_method' => $this->payment_method,
            'payment_status' => $this->payment_status,
            'courier_id' => $this->courier_id, 
            'cancellation' => $this->cancellation ? [
                'id' => $this->cancellation->id,
                'order_id' => $this->cancellation->order_id,
                'reason_id' => $this->cancellation->reason_id,
                'custom_reason' => $this->cancellation->custom_reason,
                'cancelled_at' => $this->cancellation->cancelled_at,
                'reason' => $this->cancellation->reason ? [
                    'id' => $this->cancellation->reason->id,
                    'name' => $this->cancellation->reason->reason, 
                ] : null,
            ] : null,
            'order_items' => $this->orderItems->map(function ($item) {
                return [
                    'id' => $item->id,
                    'price' => $item->product_price ?? 0, // Thêm giá trị mặc định nếu null
                    'price_sale' => $item->product_price_sale ?? null, // Giữ null nếu không có giá sale
                    'product' => $item->productVariant && $item->productVariant->product ? [ // Kiểm tra productVariant và product tồn tại
                        'id' => $item->productVariant->product->id,
                        'slug' => $item->productVariant->product->slug,
                        'name' => $item->productVariant->product->name,
                        'image' => $item->productVariant->product->image ? Storage::url($item->productVariant->product->image) : null,
                    ] : null,
                    'product_name' => $item->product_name,
                    'product_sku' => $item->product_sku,
                    'product_image' => $item->product_image ? Storage::url($item->product_image) : null,
                    'variant_size_name' => $item->variant_size_name,
                    'variant_color_name' => $item->variant_color_name,
                    'quantity' => $item->quantity ?? 1, // Giá trị mặc định nếu quantity null
                ];
            }),
            'created_at' => $this->created_at->toDateTimeString(),
            'updated_at' => $this->updated_at->toDateTimeString(),
        ];
    }
}
