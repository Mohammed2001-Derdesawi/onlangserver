<?php

namespace Modules\Course\Entities;
use Conner\Likeable\Likeable;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Modules\Course\Entities\Review;
use Illuminate\Database\Eloquent\Model;
use Modules\Course\Entities\Attachment;
use Coderflex\Laravisit\Concerns\CanVisit;
use Coderflex\Laravisit\Concerns\HasVisits;
use Haruncpi\LaravelUserActivity\Traits\Loggable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Course extends Model  implements CanVisit
{

    use HasSlug ,Likeable,HasVisits,Loggable;

    protected $fillable=['title_ar','title_en',
    'price',
    'description_ar',
    'description_en',
    'meta_description',
    'features',
    'duration',
    'start_at',
    'end_at',
    'added_id',
    'visiable',
    'preview_video',
    'image','type',
    'language_id',
    "slug"
];
 protected $casts=[
     'start_at'=>'datetime',
     'end_at'=>'datetime'
 ];
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




   public function attachment(){
    return $this->morphOne(Attachment::class,'attachmentable');
   }


   public function teachers(): BelongsToMany
   {
       return $this->belongsToMany(Teacher::class, 'course_teacher', 'course_id', 'teacher_id');
   }
   /**
    * Get all of the lectures for the Course
    *
    * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */
   public function lectures(): HasMany
   {
       return $this->hasMany(Lecture::class, 'course_id', 'id');
   }
   public function freeLectures(): HasMany
   {
       return $this->hasMany(Lecture::class, 'course_id', 'id')->where('type' , 0)->where('visiable' , 1)->orderBy('order');
   }
   public function students(): BelongsToMany
   {
       return $this->belongsToMany(Course::class,'course_user','course_id','user_id')->withPivot(['joined_at','price','paid_by']);
   }
   /**
    * Get the language that owns the Course
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
   public function language(): BelongsTo
   {
       return $this->belongsTo(Language::class, 'language_id', 'id');
   }
   public function scopeSearch($q)
   {
      $search=request()->search;
       if($search)
       {
        $q->where('title_ar','LIKE','%'.$search.'%')->orWhere('title_en','LIKE','%'.$search.'%')->orWhereHas('language',function($q) use($search){
            $q->where('title_ar','LIKE','%'.$search.'%')->orWhere('title_en','LIKE','%'.$search.'%');
        });
       }
   }
   public function scopeLanguage($q)
   {
      $language=request()->language;
      if($language)
      {
        $q->where('language_id',$language);
      }
   }
   public function reviews()
   {
       return $this->hasMany(Review::class, 'course_id', 'id');
   }

}
