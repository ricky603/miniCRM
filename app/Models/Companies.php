<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Companies extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function employee()
    {
        return $this->hasMany(\App\Models\Employees::class, 'company_id', 'id');
    }
}