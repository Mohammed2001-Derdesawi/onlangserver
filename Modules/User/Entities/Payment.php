<?php

namespace Modules\User\Entities;

use Modules\Course\Entities\Course;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelUserActivity\Traits\Loggable;

class Payment extends Model
{
    use Loggable;
    public $timestamps = true;
  protected $fillable = ['user_id' ,'total' ,'payment_type' , 'session_id' , 'payment_method'];



  public function users(){
      return $this->belongsTo(User::class, 'user_id', 'id');
  }


    public function payments_details(){
        return $this->hasMany(PaymentDetails::class, 'payment_id', 'id');
    }

//     public function courses(){
//         return $this->hasManyThrough(Course::class,PaymentDetails::class, 'payment_id', '', 'id');
//
//     }


}
