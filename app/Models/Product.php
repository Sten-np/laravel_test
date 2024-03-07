<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Product extends Model
{
    use HasFactory, Searchable;

    protected $fillable = ['name', 'description', 'image'];

    public function searchableAs()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
        ];
    }

    public function prices()
    {
        return $this->hasMany(Price::class);
    }

    public function latest_price()
    {
        return $this->hasOne(Price::class)->orderBy('created_at','desc');
    }

}
