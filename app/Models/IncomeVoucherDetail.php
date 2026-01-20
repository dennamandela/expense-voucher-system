<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncomeVoucherDetail extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $table = 'income_details';

    public function income()
    {
        return $this->belongsTo(IncomeVoucher::class, 'income_voucher_id');
    }
}
