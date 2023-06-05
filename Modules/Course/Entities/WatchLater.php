<?php

namespace Modules\Course\Entities;

use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelUserActivity\Traits\Loggable;

class WatchLater extends Model
{
    use Loggable;
    protected $fillable = ['various_id' ,'user_id'];


    public function video()
    {
        return $this->belongsTo(Various::class,'various_id' , 'id');
    }


}
