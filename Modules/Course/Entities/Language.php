<?php

namespace Modules\Course\Entities;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Modules\Course\Entities\Course;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelUserActivity\Traits\Loggable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Language extends Model
{

    use HasSlug ,Loggable;

    protected $fillable = ["title_en","title_ar","added_id" , "image",  "slug"];
    /**
     * Get all of the courses for the Language
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
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

    public function courses(): HasMany
    {
        return $this->hasMany(Course::class, 'language_id', 'id');
    }
    public function scopeSearch($q){
        $search=request()->search;
        if($search)
        {
            $q->where('title_ar','LIKE','%'.$search.'%')->orWhere('title_en','LIKE','%'.$search.'%');
        }
    }
}
