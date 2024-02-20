<?php

namespace App\Models\Client;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Client extends Model
{
   

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'user_id',
        'phone',
        'address',
    ];

     /**
     * Retrieves the user associated with the client
     * This class belongs top the user because a client is a type of user
     * 
     * @return BelongsTo
     */
    function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id', 'user_id')->where('user_type', 'client');
    }

}
