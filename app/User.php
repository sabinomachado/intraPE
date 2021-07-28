<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;


    protected $connection = 'acesso';
    protected $table = 'usuarios';
    protected $dates= ['created_at', 'updated_at'];
    protected $primaryKey = 'login';


    public $incrementing = false;




    public function getAuthPassword(){
        return $this->senha;
    }

    protected $fillable = [
       'login', 'nome', 'senha', 'setores_id', 'data_nascimento'
    ];

    protected $hidden = [
        'senha', 'remember_token',
    ];

    function getPrivilegio()
    {

    return $this->belongsTo(UsuarioSistema::class, 'login', 'usuarios_login')

    ->where('sistemas_id', '=', 843);

    }

    function getDadosFuncionario()
    {
        return $this->belongsTo(Funcionarios::class, 'login', 'matricula');
    }


}

