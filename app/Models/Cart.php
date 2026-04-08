<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable =
        [
            'store_id',
            'user_id',
            'chair_id',
            'total_amount',
        ];

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function chair()
    {
        return $this->belongsTo(Chair::class);
    }

    public function cartMenus()
    {
        return $this->hasMany(CartMenu::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
