<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    protected $fillabale = [
        'name',
        'quantity',
        'price'
    ];


    public function cart(){
        return $this->hasMany(Carts::class, 'inventory_id');
    }
}
