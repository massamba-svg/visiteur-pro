<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'company',
        'email',
        'phone',
        'address',
    ];

    /**
     * Relation : Un client a plusieurs visites
     */
    public function visits()
    {
        return $this->hasMany(Visit::class);
    }

    /**
     * Accesseur : Nom complet du client
     */
    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }
}
