<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentDonation extends Model
{
    use HasFactory;

    protected $table = 'donations';
    protected $fillable = ['user_id', 'amount', 'card_last_digits'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
