<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hobby extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'hobbies';

    protected $fillable = [
        'student_id',
        'hobby',
    ];

    /**
     * Get the student that has the hobby.
     */
    public function studentRelation()
    {
        return $this->belongsTo(Student::class);
    }
}
