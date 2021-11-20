<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Location extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table='locations';

    protected $fillable = [
        'student_id',
        'name',
    ];

    /**
     * Get the student that owns the location.
     */
    public function studentRelation()
    {
        return $this->belongsTo(Student::class);
    }
}
