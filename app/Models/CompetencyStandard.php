<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompetencyStandard extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function major()
    {
        return $this->belongsTo(Major::class, 'major_id');
    }

    public function user()
    {   
        return $this->belongsTo(User::class);   
    }
}
