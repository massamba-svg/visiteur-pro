<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    protected $fillable = [
        'visitor_name',
        'client_id',
        'person_met',
        'reason',
        'arrival_time',
        'departure_time',
        'status',
        'user_id',
    ];

    protected $casts = [
        'arrival_time' => 'datetime',
        'departure_time' => 'datetime',
    ];

    /**
     * Relation : Une visite appartient à un client
     */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * Relation : Une visite appartient à un utilisateur
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
