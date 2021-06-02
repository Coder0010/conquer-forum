<?php

namespace App\Domains\Auth\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class PasswordResetNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $token;

    public function __construct($token)
    {
        $this->token = $token;
    }

    public function via($notifiable)
    {
        return ["mail"];
    }

    public function toMail($notifiable)
    {
        if(request()->is('admin/*')){
            $urlResetForm = config("app.url").route("admin.password.reset", ["token" => $this->token, "email" => $notifiable->getEmailForPasswordReset()], false);
        }elseif(request()->is('api/*') && request()->header("accept") == "application/json" && request()->header("Request-Type") == "api"){
            $urlResetForm = config("app.url")."/api/auth/password/reset/?token=". $this->token."/?email=".$notifiable->getEmailForPasswordReset();
        } else {
            $urlResetForm = url(config("app.url").route("password.reset", ["token" => $this->token, "email" => $notifiable->getEmailForPasswordReset()], false));
        }
        return (new MailMessage)
            ->subject(GetSettingTransByKey("name")." Reset Password Email Link")
            ->line(__("You are receiving this email because we received a password reset request for your account."))
            ->action(__("Reset Password"), $urlResetForm)
            ->line(__("This password reset link will expire in :count minutes.", ["count" => config("auth.passwords.users.expire")]))
            ->line(__("If you did not request a password reset, no further action is required."));
    }

}
