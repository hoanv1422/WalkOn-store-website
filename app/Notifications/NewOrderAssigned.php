<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewOrderAssigned extends Notification
{
    use Queueable;

    protected $order;

    public function __construct($order)
    {
        $this->order = $order;
    }

    public function via($notifiable)
    {
        // Có thể sử dụng nhiều kênh: mail, database, broadcast, etc.
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Đơn hàng mới đã được gán cho bạn')
            ->line('Bạn có một đơn hàng mới cần giao.')
            ->line('Mã đơn hàng: ' . $this->order->order_number)
            ->action('Xem chi tiết', url('/shipper/orders/' . $this->order->id))
            ->line('Vui lòng xác nhận đơn hàng sớm nhất có thể!');
    }

    
    public function toDatabase($notifiable)
    {
        return [
            'subject_type' => 'App\Models\Order',
            'subject_id' => $this->order->id,
            'type' => 'new_order',
            'title' => 'Đơn hàng mới',
            'message' => 'Bạn có đơn hàng mới cần giao.',
            'data' => [
                'order_number' => $this->order->order_number,
                'customer_name' => $this->order->customer_name,
                // Các thông tin khác về đơn hàng
            ],
            'action_url' => '/shipper/orders/' . $this->order->id,
            'action_text' => 'Xem đơn hàng',
            'priority' => 'high',
            'channels_sent' => ['database', 'mail']
        ];
    }
}
