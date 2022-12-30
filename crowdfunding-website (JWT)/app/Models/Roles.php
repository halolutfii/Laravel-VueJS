<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traints\UsesUuid;

class Roles extends Model
{
    use HasFactory, UsesUuid;
    protected $fillable=['name']; 

    public function users(){
        return $this->hasMany(User::class, 'role_id');
    }
}

