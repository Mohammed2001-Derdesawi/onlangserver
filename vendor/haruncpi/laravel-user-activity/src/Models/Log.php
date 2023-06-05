<?php namespace Haruncpi\LaravelUserActivity\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Admin\Entities\Admin;

class Log extends Model
{
    public $timestamps = false;
    public $dates = ['log_date'];
    protected $appends = ['dateHumanize','json_data'];

    private $userInstance = "\App\User";

    public function __construct() {
        $userInstance = config('user-activity.model.user');
        if(!empty($userInstance)) $this->userInstance = $userInstance;


    }

    public function getDateHumanizeAttribute()
    {
        return $this->log_date->diffForHumans();
    }

    public function getJsonDataAttribute()
    {
        return json_decode($this->data,true);
    }

    public function user()
    {
        return $this->morphTo();
    }

}
