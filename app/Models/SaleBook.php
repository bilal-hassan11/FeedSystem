<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\DianujHashidsTrait;

class SaleBook extends Model
{
    use HasFactory, DianujHashidsTrait;

    protected $table = 'sales_book';
    

    public function item(){
        return $this->belongsTo(Item::class, 'item_id', 'id');
    }

    public function account(){
        return $this->belongsTo(Account::class, 'account_id', 'id');
    }

    public function outwardDetail(){
        return $this->hasMany(OutwardDetail::class, 'outward_id', 'item_id');
    }
}
