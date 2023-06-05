<?php

namespace Modules\Course\Entities;

use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelUserActivity\Traits\Loggable;

class Opinion extends Model
{
    use Loggable;
    protected $fillable = ["opinion_ar","opinion_en","image"];

    public function scopeSearch($q)
    {
       $search=request()->search;
        if($search)
        {
         $q->where('opinion_ar','LIKE','%'.$search.'%')->orWhere('opinion_en','LIKE','%'.$search.'%');
        }
    }
}
