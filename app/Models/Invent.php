<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invent extends Model
{
    use HasFactory;

    protected $fillable =
        [
            'store_id',
            'name',
            'stock',
            'unit',
        ];

    public function menus()
    {
        return $this->belongsToMany(Menu::class, 'invent_menus')
            ->withPivot('quantity_used')
            ->withTimestamps();
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }
}
