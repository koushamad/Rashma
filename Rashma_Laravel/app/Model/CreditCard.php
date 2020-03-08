<?php

namespace App\Model;

use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class CreditCard extends Model
{
    use Notifiable, SoftDeletes, Cachable;

    protected $cachePrefix = "model-credit_cards";

    protected $cacheCooldownSeconds = 10;

    protected $primaryKey = 'id';

    protected $table = 'credit_cards';

    protected $fillable = ['walletId','cardNumber'];

    protected $hidden = ['created_at','updated_at','deleted_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function Transaction(){
        return $this->hasMany(Transaction::class,'creditCardId','id');
    }
}
