<?php

namespace Modules\Course\Entities;

use Conner\Likeable\Likeable;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Modules\Course\Entities\Course;
use Illuminate\Database\Eloquent\Model;
use Modules\Course\Entities\Attachment;
use Coderflex\Laravisit\Concerns\CanVisit;
use Coderflex\Laravisit\Concerns\HasVisits;
use Haruncpi\LaravelUserActivity\Traits\Loggable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Lecture extends Model implements CanVisit
{
    use HasSlug ,Likeable ,HasVisits,Loggable;


    use Likeable ;
    protected $fillable = ["title_en","title_ar","description_ar","description_en",
    "path_video","duration","visiable",
    "type","order","added_id","course_id","poster" ,"slug"];

    /**
     * Get the course that owns the Lecture
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */


     public function getSlugOptions() : SlugOptions
     {
         return SlugOptions::create()
             ->generateSlugsFrom('title_en')
             ->saveSlugsTo('slug')
             ->slugsShouldBeNoLongerThan(50);

     }

     public function getRouteKeyName()
     {
         return 'slug';
     }

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class, 'course_id', 'id');
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
         $q->where('title_ar','LIKE','%'.$search.'%')->orWhere('title_en','LIKE','%'.$search.'%')->orWhereHas('course',function($q) use($search){
             $q->where('title_ar','LIKE','%'.$search.'%')->orWhere('title_en','LIKE','%'.$search.'%');
         });
        }
    }

}
