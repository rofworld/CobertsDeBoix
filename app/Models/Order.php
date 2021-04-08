<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';
    public $fillable = [ 'user_id','send_name','send_address','city','postal_code','country','provincia','total_price','state','cashOnDelivery'];


}
