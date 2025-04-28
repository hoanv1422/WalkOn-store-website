<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Order;
use App\Models\PostComments;
use App\Policies\OrderPolicy;
use App\Policies\PostCommentPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Notifications\Messages\MailMessage;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
        Order::class => OrderPolicy::class,
        PostComments::class => PostCommentPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
        $this->registerPolicies();

        Gate::define('delete-comment', function ($user, PostComments $comment) {
            // Cho phép user sở hữu comment hoặc admin xóa
            return $user->id === $comment->user_id || $user->hasRole('admin');
        });

        VerifyEmail::toMailUsing(function ($notifiable, $url) {
            return (new MailMessage)
                ->subject('Xác thực email của bạn ')
                ->view('emails.verify_email', ['verificationUrl' => $url]);
        });
    }
}
