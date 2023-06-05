<?php

namespace Modules\Course\Entities;

use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelUserActivity\Traits\Loggable;

class Note extends Model
{
    use Loggable;

    protected $fillable = ['text', 'user_id', 'lecture_id'];


}
