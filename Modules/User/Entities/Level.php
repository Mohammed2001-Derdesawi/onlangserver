<?php

namespace Modules\User\Entities;

use Modules\Course\Entities\Course;
use Modules\User\Entities\Campaign;
use Modules\User\Entities\LevelGift;
use Modules\User\Entities\UserLevel;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelUserActivity\Traits\Loggable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Level extends Model
{
    use Loggable;
    protected $fillable = ['title_ar','title_en','description_ar','description_en','total_point','point_price','order','point_per_one','campaign_id',"point_price_after_done"];

   /**
    * Get the campain that owns the Level
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
   public function campaign(): BelongsTo
   {
       return $this->belongsTo(Campaign::class, 'campaign_id', 'id');
   }
   /**
    * Get all of the gifts for the Level
    *
    * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */
   public function gifts(): HasMany
   {
       return $this->hasMany(LevelGift::class, 'level_id', 'id');
   }
   /**
    * The courses that belong to the Level
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
    */
   public function courses(): BelongsToMany
   {
       return $this->belongsToMany(Course::class, 'level_gifts', 'level_id', 'course_id');
   }
   /**
    * Get all of the users for the Level
    *
    * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */
   public function users(): HasMany
   {
       return $this->hasMany(UserLevel::class, 'level_id', 'id');
   }

   public function nextLevel()
    {
        return static::where('campaign_id',$this->campaign_id)->where('order','>',$this->order)->orderBy('order')->limit(1)->first();
    }

   public function scopeSearch($q)
   {
      $search=request()->search;
       if($search)
       {
        $q->where('title_ar','LIKE','%'.$search.'%')->orWhere('title_en','LIKE','%'.$search.'%')->orWhereHas('campaign',function($q) use($search){
            $q->where('title_ar','LIKE','%'.$search.'%')->orWhere('title_en','LIKE','%'.$search.'%');
        });
       }
   }
   public function scopeCampaign($q){
    $campaign=request()->campaign;
    if($campaign){
        $q->where('campaign_id',$campaign);
    }
   }



}
