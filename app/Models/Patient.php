<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'document',
        'first_name',
        'last_name',
        'birth_date',
        'email',
        'phone',
        'gender'
    ];


    public function patient_diagnoses()
    {
        return $this->hasMany(PatientDiagnose::class);
    }
}
