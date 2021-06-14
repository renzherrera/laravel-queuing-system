<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    protected $fillable = [
        'department_name',
        'is_active',
    ];

    public function services() {
        return $this->hasMany(Service::class);

    }
}
