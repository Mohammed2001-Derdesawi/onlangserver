<?php

namespace Modules\User\Entities;

use Spatie\Sluggable\HasSlug;
use Modules\User\Entities\Level;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelUserActivity\Traits\Loggable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Campaign extends Model
{
    use HasSlug,Loggable;

    protected $fillable = ['title_ar','title_en',"feachers_en","feachers_ar",'description_ar','description_en',"slug",'start_at','end_at','total_points'];

    /**
     * Get all of the levels for the Campaign
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function levels(): HasMany
    {
        return $this->hasMany(Level::class, 'campaign_id', 'id');
    }

    public function lastLevel()
    {
        return $this->hasOne(Level::class,'campaign_id','id')->ofMany('order','max');
    }

    public function scopeSearch($q)
    {
       $search=request("search");
        if($search)
        {
         $q->where('title_ar','LIKE','%'.$search.'%')->orWhere('title_en','LIKE','%'.$search.'%');
        }
    }
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title_en')
            ->saveSlugsTo('slug');
    }







}
