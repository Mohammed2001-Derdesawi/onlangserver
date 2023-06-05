<?php

namespace Modules\Admin\Entities;

use Laravel\Sanctum\HasApiTokens;
use Modules\User\Entities\Message;
use Modules\Course\Entities\Course;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Haruncpi\LaravelUserActivity\Traits\Loggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Modules\Admin\Notifications\AdminResetPasswordNotification;

class Admin extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable,CanResetPassword,HasRoles,Loggable;
    protected $guards=['admin'];
    protected $table = 'admins';
    public $timestamps = true;
    protected $fillable = [
        'name',
        'email',
        'password',
        'image',
        'last_login_at',
    ];
    protected $casts=[
        'created_at'=>'datetime',
        'last_login_at'=>'datetime',
        'updated_at'=>'datetime',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];


    public function added_courses()
    {
        return $this->hasMany(Course::class, 'added_id', 'id');
    }
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new AdminResetPasswordNotification($token));
    }
    public function getEmailForPasswordReset()
    {
        return $this->email;
    }

    public function sentMessages()
    {
        return $this->morphMany(Message::class, 'sender');
    }

    // Define the relationship with received messages
    public function receivedMessages()
    {
        return $this->morphMany(Message::class, 'receiver');
    }
    public function UnReardreceivedMessages()
    {
        return $this->morphMany(Message::class, 'receiver')->whereNull('read_at');
    }

    public function scopeSearch($q)
    {
        $search=request('search');
        if($search)
        $q->where('name','LIKE','%'.$search.'%')->orwhere('name','LIKE','%'.$search.'%')->orwhereHas('roles',function($q) use($search){
           $q->where('title','LIKE','%'.$search.'%');
        });
    }

}
