<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{

    protected $table = 'carts';
    public $timestamps = true;
    protected $fillable = [
      'user_id',
      'total',


    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function cart_items()
    {
        return $this->hasMany(CartItem::class, 'cart_id', 'id');
    }

}
