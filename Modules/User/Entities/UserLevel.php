<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelUserActivity\Traits\Loggable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserLevel extends Model
{
    use Loggable;
    protected $fillable = ["user_id","level_id","points","is_done","gift_type"];

    /**
     * Get the user that owns the UserLevel
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Get the level that owns the UserLevel
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function level(): BelongsTo
    {
        return $this->belongsTo(Level::class, 'level_id', 'id');
    }

    public function isFinished($point_per_one){
        $total=$this->level->total_point;
        $earnpoints=$this->points+$point_per_one;
        if($earnpoints>= $total)
        {
            $diff=$earnpoints-$total;
            if($diff<0)
            $diff*=-1;
            return [true,$diff];
        }
        return [false,$earnpoints];


    }

    public function percentage(){
        $total=$this->level->total_point;
        return (int) $total==0?0:$this->points/$total;
    }
}
