<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\User\Entities\Article;
class AttachmentArticle extends Model
{
    protected $fillable = [
        'lecture_id',
        'path',
        'file_title',
    ];
    protected $table = 'attachments_article';
    public $timestamps = true;
    public function article(){
        return $this->belongsTo(Article::class,'article_id','id');
    }}
