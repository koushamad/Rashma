<?php

namespace App\Model;

use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Wallet extends Model
{
    use Notifiable, SoftDeletes, Cachable;

    protected $cachePrefix = "model-wallets";

    protected $cacheCooldownSeconds = 10;

    protected $primaryKey = 'id';

    protected $table = 'wallets';

    protected $fillable = ['profileId', 'cash', 'unit'];

    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function CreditCard()
    {
        return $this->hasOne(CreditCard::class, 'walletId', 'id')->with('Transaction');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function Transactions()
    {
        return $this->hasMany(Transaction::class, 'walletId', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function WalletLedgers()
    {
        return $this->hasMany(WalletLedger::class, 'walletId', 'id');
    }
}
