<?php

namespace Modules\User\Entities;

use Modules\User\Entities\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserInfo extends Model
{
    protected $fillable = ["user_id","bank_name","bank_number",
    "account_iban","bank_country"
    ,"bank_code","bank_address"
    ,"account_name","bank_currency","identity_image"];

    /**
     * Get the user that owns the UserInfo
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
