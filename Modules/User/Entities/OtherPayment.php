<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;

class OtherPayment extends Model
{
    protected $fillable = ['name' ,'email' ,'price' ,'session_id'];

}
