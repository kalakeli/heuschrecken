<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Method extends Model
{
    use HasFactory;

    protected $table = "tblMethods"; // Current
    protected $primaryKey = 'methodPKID';
    // nothing to hide here
    protected $guarded = []; 
}
