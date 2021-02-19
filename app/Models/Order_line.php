<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_line extends Model
{
    use HasFactory;
    protected $table = 'order_lines';
    public $fillable = ['order_id', 'product_id','product_name','units','unit_price','total_line_price'];

}
