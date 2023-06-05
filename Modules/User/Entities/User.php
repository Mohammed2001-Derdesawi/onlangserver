<?php

namespace Modules\User\Entities;

use Exception;
use Carbon\Carbon;
use App\Models\Session;
use Conner\Likeable\Like;
use Laravel\Cashier\Billable;
use Laravel\Sanctum\HasApiTokens;
use Modules\Course\Entities\Note;
use Modules\User\Entities\Wallet;
use Modules\User\Entities\Message;
use Modules\Course\Entities\Course;
use Modules\Course\Entities\Review;
use Illuminate\Database\Eloquent\Model;
use Modules\Course\Entities\WatchLater;
use Modules\User\Entities\MessageGroup;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Haruncpi\LaravelUserActivity\Traits\Loggable;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable , Billable,Loggable;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'age',
        'image',
        'gender',
        'phone',
        'share_slug',
        'is_start_campaigns',
        "uuid",
        "campaign_type",
        "connect_account_id",
        "has_completed_on_boarding",
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

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];



    public function courses()
    {
        return $this->belongsToMany(Course::class, 'course_user', 'user_id', 'course_id');
    }
    /**
     * Get all of the notes for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    // public function notes(): HasMany
    // {
    //     return $this->hasMany(Note::class, 'user_id', 'id');
    // }

    // /**
    //  * Get all of the likes for the User
    //  *
    //  * @return \Illuminate\Database\Eloquent\Relations\HasMany
    //  */
    // public function likes()
    // {
    //     return $this->morphMany(Like::class,'likeable');
    // }
    // /**
    //  * Get all of the notes for the User
    //  *
    //  * @return \Illuminate\Database\Eloquent\Relations\HasMany
    //  */
    // public function reviews(): HasMany
    // {
    //     return $this->hasMany(Review::class, 'user_id', 'id');
    // }

    public function payments(){
        return $this->hasMany(Payment::class, 'user_id', 'id');
    }
    public function payments_various(){
        return $this->hasOne(VariousPayment::class, 'user_id', 'id');
    }
    public function sessions() {
         return $this->hasMany(Session::class , 'user_id' , 'id');
    }
    public function playlists() {
        return $this->hasMany(Playlist::class , 'user_id' , 'id');
     }

     public function watchlaters() {
      return $this->hasMany(WatchLater::class , 'user_id' , 'id');


     }

    /**
     * Get all of the levels for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function levels(): HasMany
    {
        return $this->hasMany(UserLevel::class, 'user_id', 'id');
    }

    /**
     * Get the currentLevelInCampaign $idassociated with the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function currentLevelInCampaign(): HasOne
    {
        return $this->hasOne(UserLevel::class, 'user_id', 'id')->latestOfMany();
    }

    /**
     * Get the user associated with the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function userInfo(): HasOne
    {
        return $this->hasOne(userInfo::class, 'user_id', 'id');
    }

    /**
     * Get the loginBy that owns the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function loginBy(): HasOne
    {
        return $this->hasOne(UserLoginBy::class, 'register_id', 'id');
    }

    /**
     * Get all of the registers for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function usersloginByMe(): HasMany
    {
        return $this->hasMany(UserLoginBy::class, 'login_by', 'id');
    }

     /**
     * Get the wallet associated with the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function wallet(): HasOne
    {
        return $this->hasOne(Wallet::class, 'user_id', 'id');
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

     public function messageGroups()
     {
        return $this->belongsToMany(MessageGroup::class,'user_group','user_id','group_id');
     }




     public function scopeGroup($q)
     {
        if(request()->group)
        {
            $q->whereHas('messageGroups',function($q){
                $q->where('id',request()->group);
            });
        }
     }

     public function lastSentMessage()
     {
        return $this->morphOne(Message::class, 'sender')->latestOfMany();
    }
    public function scopeSearch($q){
        $search=request()->search;
        if($search)
        {
            $q->where(function($q) use($search){
               $q->where('name','LIKE','%'.$search.'%')->orwhere('email','LIKE','%'.$search.'%')->orWhereHas('courses',function($q) use($search){
                $q->where('title_ar','LIKE','%'.$search.'%')->orwhere('title_en','LIKE','%'.$search.'%');
               });
            });
        }
    }

public function reviews(): HasMany
{
    return $this->hasMany(Review::class, 'user_id','id');
}



    public function notes(): HasMany
    {
        return $this->hasMany(Note::class, 'user_id', 'id');
    }


    public function likes()
    {
        return $this->morphMany(Like::class,'likeable');
}




public function scopeCourseSubscribes($q){
    if(request()->typeusers && request()->typeusers=='unsubscribe'){
     
        return  $q->whereDoesntHave('courses');

    }
}

public function scopeDate($q){
    if(request()->from && request()->to){
        try{
            if(request()->from){
                $from=Carbon::createFromFormat('Y-m-d', request()->from);
            }
            if(request()->to){
                $to=Carbon::createFromFormat('Y-m-d', request()->to);
             }
             else
             {
                 $to=now();
             }
           
             return $q->whereBetween('created_at',[$from,$to]);

        }catch(Exception $e){

        }
    }
}


}
