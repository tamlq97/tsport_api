<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Order extends Model
{
    use Notifiable;

    protected $guarded = [];
    public function detail()
    {
        # code...
        return $this->hasMany('App\Models\OrderDetail');
    }
    public function customer()
    {
        # code...
        return $this->hasOne('App\Models\Customer', 'user_id', 'user_id');
    }
    public function payment()
    {
        # code...
        return $this->hasOne('App\Models\Payment', 'id', 'payment_id');
    }
}
