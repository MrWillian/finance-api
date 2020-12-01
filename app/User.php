<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Notifications\Notification;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Support\Facades\Crypt;

class User extends Authenticatable implements JWTSubject
{
  use Notifiable;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'name', 'email', 'phone_number', 'password'
  ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
      'password', 'remember_token'
  ];

  /**
   * The attributes that should be cast to native types.
   *
   * @var array
   */
  protected $casts = [
      'email_verified_at' => 'datetime',
  ];

  public function getJWTIdentifier()
  {
    return $this->getKey();
  }

  public function getJWTCustomClaims()
  {
    return [];
  }
  
  /**
   * Return the SMS notification routing information.
   *
   * @param \Illuminate\Notifications\Notification|null $notification
   *
   * @return mixed
   */
  public function routeNotificationForSms(?Notification $notication = null)
  {
    return $this->phone_number;
  }

  public function routeNotificationForMail($notification)
  {
    return $this->email;
  }

  public function getNameAttribute($value) {
    return $this->decryptAttribute($value);
  }

  public function getPhoneNumberAttribute($value) {
    return $this->decryptAttribute($value);
  }

  private function decryptAttribute($value) {
    return Crypt::decryptString($value);
  }
}
