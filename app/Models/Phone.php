<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Phone extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table='phones';

    protected $fillable = [
        'student_id',
        'phone',
    ];

    /**
     * Get the student that owns the phone.
     */
    public function studentRelation()
    {
        return $this->belongsTo(Student::class);
    }
}
