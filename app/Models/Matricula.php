<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matricula extends Model
{
    use HasFactory;

    protected $primaryKey = 'idMatricula';

    protected $fillable = [
        'idMatricula',
        'idEstudiante',
         'idCurso',
         'fechaMatriculacion',
         'calificacion'
    ];
}