<?php

namespace Modules\Course\Entities;

use Conner\Likeable\Likeable;
use Modules\Course\Entities\Review;
use Illuminate\Database\Eloquent\Model;
use Modules\Course\Entities\Attachment;
use Modules\Course\Entities\VariousGroup;
use Coderflex\Laravisit\Concerns\CanVisit;
use Coderflex\Laravisit\Concerns\HasVisits;
use Haruncpi\LaravelUserActivity\Traits\Loggable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\User\Entities\playlistVideos;

class Various extends Model implements CanVisit
{

    use Likeable,HasVisits,Loggable;

    protected $fillable = ["title_ar","title_en","description_en","description_ar","added_id","group_id","poster","type","path"];

    /**
     * Get the group that owns the Various
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function group(): BelongsTo
    {
        return $this->belongsTo(VariousGroup::class, 'group_id', 'id');
    }
    public function attachments()
    {
        return $this->morphMany(Attachment::class,'attachmentable');
    }
    public function scopeSearch($q)
    {
       $search=request()->search;
        if($search)
        {
         $q->where('title_ar','LIKE','%'.$search.'%')->orWhere('title_en','LIKE','%'.$search.'%')->orWhereHas('group',function($q) use($search){
             $q->where('title_ar','LIKE','%'.$search.'%')->orWhere('title_en','LIKE','%'.$search.'%');
         });
        }
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'variouse_id', 'id');
    }


    public function userPlaylist(){
        return $this->hasMany(playlistVideos::class,'video_id','id');
    }



}
