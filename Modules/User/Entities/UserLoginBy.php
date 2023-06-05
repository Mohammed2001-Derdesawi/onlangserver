<?php

namespace Modules\User\Entities;

use Modules\User\Entities\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserLoginBy extends Model
{
    protected $table='user_login_by';
    protected $fillable = ["login_by","register_id","campaign_id","is_get_point"];

    /**
     * Get the loginBy that owns the UserLoginBy
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function shareUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'login_by', 'id');
    }
    public function registerUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'register_id', 'id');
    }
    public function campaign(): BelongsTo
    {
        return $this->belongsTo(Campaign::class, 'campaign_id', 'id');
    }

}
