<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shopping_Cart_Line extends Model
{
    use HasFactory;
    public $fillable = ['shopping_cart_id', 'product_id','product_name','units','unit_price','total_line_price'];
}
