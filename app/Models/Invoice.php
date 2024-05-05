<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;
use MongoDB\Laravel\Relations\EmbedsOne;
class Invoice extends Model
{
    use HasFactory;
    protected $collection = 'invoices';
    protected $fillable = ['id', 'order', 'customer', 'status', 'price' ,'pix'];

    public function order(): EmbedsOne
    {
        return $this->embedsOne(Order::class);
    }

    public function customer(): EmbedsOne
    {
        return $this->embedsOne(Customer::class);
    }

}
