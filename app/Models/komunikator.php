<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class komunikator extends Model
{
    protected $table = 'komunikator';
    protected $fillable = [
        'od',
        'do',
        'wiadomosc',
        'kiedy_wyslano',
        'kiedy_odebrano',
    ];
    protected $casts = [
        'kiedy_wyslano' => 'datetime',
        'kiedy_odebrano' => 'datetime',
    ];

    // Uzyskiwanie wyslanych
    public function scopeSentBy($query, $userId)
    {
        return $query->where('od', $userId);
    }

    // Uzyskiwanie odebranych
    public function scopeReceivedBy($query, $userId)
    {
        return $query->where('do', $userId);
    }
}
