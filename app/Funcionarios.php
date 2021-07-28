<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Funcionarios extends Model
{
    protected $table = 'vw_funcionarios';
    protected $connection = 'mysql';
    

    public $incrementing = false;
    //public $primaryKey = ['id'];
   

    protected $fillable = ['id', 'matricula', 'cpf', 'nome', 'sexo', 'ferias_inicio'];

}
