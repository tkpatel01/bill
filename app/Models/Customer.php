<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'customers';
    public function customer()
    {
        return self::get();
    }

    public function Expense(){
        return $this->hasMany(Expense::class);
    }
    // use SoftDeletes;
}
