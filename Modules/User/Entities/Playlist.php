<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Course\Entities\VariousGroup;
use Modules\User\Entities\playlistVideos;
use Haruncpi\LaravelUserActivity\Traits\Loggable;

class Playlist extends Model
{
    use Loggable;
    protected $fillable = [

    'group_id',
    'user_id',
    'title'

];

    public function playlistVideos(){
        return $this->hasMany(playlistVideos::class, 'playlist_id', 'id');
    }

    public function groupVarious()
    {
        return $this->belongsTo(VariousGroup::class,'group_id' , 'id');
    }

        public function user()
    {
        return $this->belongsTo(User::class,'user_id' , 'id');
    }
        public function group()
    {
        return $this->belongsTo(VariousGroup::class,'group_id' , 'id');
    }

}

