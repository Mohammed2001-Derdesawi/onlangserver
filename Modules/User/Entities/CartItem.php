<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Course\Entities\Course;

class CartItem extends Model
{

    protected $table = 'cart_items';
    public $timestamps = true;
    protected $fillable = [
        'cart_id',
        'course_id',
        'price',


    ];

    public  function  cart()
    {
        return $this->belongsTo(Cart::class,'cart_id','id');
    }

    public  function  course()
    {
        return $this->belongsTo(Course::class,'course_id','id');
    }
}
