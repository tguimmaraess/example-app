<?php

namespace App\Models\Order;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\Shared\User;

class Order extends Model
{
   

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'status',
        'client_id',
    ];

    function client(): HasOne
    {
        return $this->hasOne(User::class,  'id', 'client_id')->where('user_type', 'client')->with('client');
    }

}
