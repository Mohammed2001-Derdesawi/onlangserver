<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelUserActivity\Traits\Loggable;

class VariousPayment extends Model
{
    use Loggable;
    protected $fillable = [  'user_id' , 'price','ended_at' , 'plan_id','payment_method_id'];



    public function users(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }









}
