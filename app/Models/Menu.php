<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $fillable =
        [
            'store_id',
            'name',
            'price',
            'img',
            'description',
            'category_id',
        ];

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function cartMenus()
    {
        return $this->hasMany(CartMenu::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'categories_id');
    }

    public function invents()
    {
        return $this->belongsToMany(Invent::class, 'invent_menus')
            ->withPivot('quantity_used')
            ->withTimestamps();
    }
}
