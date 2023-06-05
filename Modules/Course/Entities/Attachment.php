<?php

namespace Modules\Course\Entities;

use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelUserActivity\Traits\Loggable;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Attachment extends Model
{
    use Loggable;
    protected $fillable = ["attachmentable_id","attachmentable_type","size","title","path","type","description_ar","description_en"];

    public function attachmentable():MorphTo
    {
        return $this->morphTo(__FUNCTION__,"attachmentable_id","attachmentable_type");

    }
}
