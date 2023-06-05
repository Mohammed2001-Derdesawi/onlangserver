<?php

namespace Modules\User\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelUserActivity\Traits\Loggable;

class MessageGroup extends Model
{
    use Loggable;
    protected $fillable = ['title'];
    protected $table='message_groups';

    public function users()
    {
       return $this->belongsToMany(User::class,'user_group','group_id','user_id');
    }
}
