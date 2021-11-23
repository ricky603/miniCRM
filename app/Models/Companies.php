<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Companies extends Model implements JWTSubject
{
    use HasFactory;
    protected $guarded = [];

    public function employee()
    {
        return $this->hasMany(\App\Models\Employees::class, 'company_id', 'id');
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getJWTCustomClaims()
    {
        return [];
    }
}
