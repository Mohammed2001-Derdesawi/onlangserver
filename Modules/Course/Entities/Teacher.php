<?php

namespace Modules\Course\Entities;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Modules\Course\Entities\Course;
use Illuminate\Database\Eloquent\Model;
use Coderflex\Laravisit\Concerns\CanVisit;
use Coderflex\Laravisit\Concerns\HasVisits;
use Haruncpi\LaravelUserActivity\Traits\Loggable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Teacher extends Model implements CanVisit
{

    use HasSlug,HasVisits,Loggable;

    protected $fillable = ["name_ar","name_en","email","description_ar","description_en","image","preview_video" , "slug" , 'has_private_learning' , 'private_video'];



    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name_en')
            ->saveSlugsTo('slug')
            ->slugsShouldBeNoLongerThan(50);

    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function courses(): BelongsToMany
    {
        return $this->belongsToMany(Course::class, 'course_teacher','teacher_id','course_id');
    }
    public function scopeSearch($q)
    {
       $search=request()->search;
        if($search)
        {
         $q->where('name_ar','LIKE','%'.$search.'%')->orWhere('name_en','LIKE','%'.$search.'%')->orWhereHas('courses',function($q) use($search){
             $q->where('title_ar','LIKE','%'.$search.'%')->orWhere('title_en','LIKE','%'.$search.'%');
         });
        }
    }

}
