<?php

namespace App\Model;

use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Transaction extends Model
{
    use Notifiable, SoftDeletes, Cachable;

    protected $cachePrefix = "model-transactions";

    protected $cacheCooldownSeconds = 10;

    protected $primaryKey = 'id';

    protected $table = 'transactions';

    protected $fillable = ['creditCardId', 'walletId','cash', 'unit','trackNumber','isCashOut','isTransfer'];

    protected $hidden = ['updated_at','deleted_at','trackNumber','isCashOut','isTransfer'];
}
