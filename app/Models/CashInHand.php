<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\DianujHashidsTrait;

class CashInHand extends Model
{
    use HasFactory, DianujHashidsTrait;

    protected $table = 'cash_in_hand_detail';

    public function grand_parent(){
        return $this->belongsTo(AccountType::class, 'parent_id', 'id');
    }

    public function childs(){
        return $this->hasMany(AccountType::class, 'parent_id', 'id');
    }
}
