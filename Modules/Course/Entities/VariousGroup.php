<?php

namespace Modules\Course\Entities;

use Illuminate\Database\Eloquent\Model;
use Coderflex\Laravisit\Concerns\HasVisits;
use Haruncpi\LaravelUserActivity\Traits\Loggable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class VariousGroup extends Model
{
    protected $fillable = ["title_ar","title_en","description_en","description_ar","poster","added_id"];
    use HasVisits,Loggable;
    protected $table="various_groups";
    /**
     * Get all of the variouses for the VariousGroup
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function variouses(): HasMany
    {
        return $this->hasMany(Various::class, 'group_id', 'id');
    }
    public function scopeSearch($q)
    {
       $search=request()->search;
        if($search)
        {
         $q->where('title_ar','LIKE','%'.$search.'%')->orWhere('title_en','LIKE','%'.$search.'%');
        }
    }
}
