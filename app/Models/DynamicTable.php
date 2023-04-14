<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DynamicTable extends Model
{
    use HasFactory;
    protected $fillable = ["slot", "input_1", "input_2", "input_3"];
}
