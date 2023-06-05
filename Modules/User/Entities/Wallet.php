<?php

namespace Modules\User\Entities;

use Modules\User\Entities\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Wallet extends Model
{
    protected $fillable = ["user_id","total","last_withdraw"];

    /**
     * Get the user that owns the Wallet
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Get all of the withdraws for the Wallet
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function withdraws(): HasMany
    {
        return $this->hasMany(WalletWithdraw::class, 'wallet_id', 'id');
    }

    /**
     * Get the withdraw associated with the Wallet
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function lastWithdraw(): HasOne
    {
        return $this->hasOne(WalletWithdraw::class)->oldestOfMany();    }
}
