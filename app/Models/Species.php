<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Species extends Model
{
    use HasFactory;

    protected $table = "tblSpecies"; // Current
    protected $primaryKey = 'speciesPKID';
    // nothing to hide here
    protected $guarded = []; 
}
