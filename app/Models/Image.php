<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Image extends Model
{
    use HasFactory;

    protected $table = "tblImages"; // Current
    protected $primaryKey = 'imgPKID';
    // nothing to hide here
    protected $guarded = []; 
}
