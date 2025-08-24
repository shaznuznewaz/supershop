<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = ['customer_id','order_id', 'user_id', 'invoice_number', 'invoice_date', 'total_amount', 'notes', 'status'];

    public function customer(){
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
    public function order()
    {
    return $this->belongsTo(Order::class);
    }

    public function details()
    {
    return $this->hasMany(InvoiceDetails::class);
    }


}
