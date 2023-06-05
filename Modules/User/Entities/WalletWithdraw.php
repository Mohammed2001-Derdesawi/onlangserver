<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelUserActivity\Traits\Loggable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WalletWithdraw extends Model
{
    use Loggable;
    protected $fillable = ["wallet_id","total","withdraw_date"];

    /**
     * Get the wallet that owns the WalletWithdraw
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function wallet(): BelongsTo
    {
        return $this->belongsTo(User::class, 'wallet_id', 'id');
    }
}
