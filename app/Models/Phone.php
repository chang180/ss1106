<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Phone extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'phone',
    ];

    /**
     * Get the student that owns the phone.
     */
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
