<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvoiceDetails extends Model
{
    protected $fillable = ['invoice_id', 'product_id', 'quantity', 'amount', 'total_amount'];
    
    public function invoice()
    {
        return $this->belongsTo(Invoice::class, 'invoice_id');

    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
