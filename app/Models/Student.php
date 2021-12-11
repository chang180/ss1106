<?php

namespace App\Models;

use Database\Factories\StudentFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'students';

    protected $fillable = [
        'name',
        'chinese',
        'english',
        'math',
    ];

    /**
     * Get the phone associated with the Student
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function phoneRelation()
    {
        return $this->hasOne(Phone::class);
    }

    /**
     * Get the location associated with the Student
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function locationRelation()
    {
        return $this->hasOne(Location::class);
    }

    /**
     * Get the hobbies associated with the Student
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function hobbyRelation()
    {
        return $this->hasMany(Hobby::class);
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return StudentFactory::new();
    }
}
