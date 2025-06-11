<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GetHelp extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'surname', 'number', 'email', 'file', 'info', 'is_approved'];
}
