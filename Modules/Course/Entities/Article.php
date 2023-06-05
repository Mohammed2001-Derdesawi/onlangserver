<?php

namespace Modules\Course\Entities;
use Spatie\Sluggable\HasSlug;
use Modules\Admin\Entities\Admin;

use Spatie\Sluggable\SlugOptions;
use Modules\Course\Entities\Review;
use Illuminate\Database\Eloquent\Model;
use Modules\Course\Entities\Attachment;
use Coderflex\Laravisit\Concerns\CanVisit;
use Coderflex\Laravisit\Concerns\HasVisits;
use Haruncpi\LaravelUserActivity\Traits\Loggable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Article extends Model implements CanVisit
{

    use HasSlug,HasVisits,Loggable;

    protected $fillable = ["title_ar","title_en","description_ar","image","description_en","added_id","slug"];

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


    public function attachments()
    {
        return $this->morphMany(Attachment::class,'attachmentable');
    }

    /**
     * Get the admin that owns the Article
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function admin(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'added_id', 'id');
    }
    public function reviews()
    {
        return $this->hasMany(Review::class, 'article_id', 'id');
    }
    public function scopeSearch($q)
    {
       $search=request()->search;
        if($search)
        {
         $q->where('title_ar','LIKE','%'.$search.'%')->orWhere('title_en','LIKE','%'.$search.'%')->orWhereHas('admin',function($q) use($search){
             $q->where('name','LIKE','%'.$search.'%');
         });
        }
    }


}
