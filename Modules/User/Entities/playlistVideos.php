<?php

namespace Modules\User\Entities;

use Modules\Course\Entities\Various;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelUserActivity\Traits\Loggable;

class playlistVideos extends Model
{
    use Loggable;
    protected $fillable = [

        'playlist_id',
    'video_id',
];

protected $table='playlist_videos';


public function playlist()
{
    return $this->belongsTo(Playlist::class,'playlist_id' , 'id');
}



public function video()
{
    return $this->belongsTo(Various::class,'video_id' , 'id');
}


    }
