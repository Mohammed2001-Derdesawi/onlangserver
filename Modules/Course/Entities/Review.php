<?php

namespace Modules\Course\Entities;

use Modules\User\Entities\User;
use Modules\Course\Entities\Course;
use Modules\Course\Entities\Article;
use Modules\Course\Entities\Various;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelUserActivity\Traits\Loggable;

class Review extends Model
{
    use Loggable;
    public $timestamps = true;
    protected $fillable = ['user_id','course_id','article_id','variouse_id','review' ];


    public  function  course()
    {
        return $this->belongsTo(Course::class,'course_id','id');
    }
    public  function  article()
    {
        return $this->belongsTo(Article::class,'article_id','id');
    }

    public  function  variouse()
    {
        return $this->belongsTo(Various::class,'variouse_id','id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function scopeSearch($q){
       $search=request()->search;
       if($search)
       $q->where('review','LIKE','%'.$search.'%')->orwhereHas('user',function($q) use($search){
        $q->where('name','LIKE','%'.$search.'%');
       });
    }

}
