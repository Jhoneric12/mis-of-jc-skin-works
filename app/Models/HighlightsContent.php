<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HighlightsContent extends Model
{
    use HasFactory;

    protected $fillable = ['content'];

    protected $table = 'highlights_contents';
}
