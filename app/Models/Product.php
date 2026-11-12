<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'quantity',
        'description',
        'amount'
    ];
    public function changeQuantity(int $amount): void
    {
        $newQuantity = $this->quantity + $amount;

        if ($newQuantity < 0) {
            throw new \Exception('Produkta daudzums nevar būt mazāks par 0!');
        }

        $this->update([
            'quantity' => $newQuantity
        ]);
    }
}
