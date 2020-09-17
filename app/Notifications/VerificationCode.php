<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use App\Channels\Messages\SmsMessage;

class VerificationCode extends Notification
{
  use Queueable;
  
  /**
   * The code instance
   *
   * @var string
   */
  public $code;

  /**
   * Create a new notification instance.
   */
  public function __construct(string $code)
  {
    $this->code = $code;
  }

  /**
   * Get the notification's delivery channels.
   *
   * @param mixed $notifiable
   *
   * @return array
   */
  public function via($notifiable)
  {
    return ['sms'];
  }

  /**
   * Get the SMS representation of the notification.
   *
   * @param mixed $notifiable
   *
   * @return \App\Channels\Messages\SmsMessage
   */
  public function toSms($notifiable)
  {
    return new SmsMessage($this->code);
  }
}
