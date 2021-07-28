<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsuarioSistema extends Model
{
    protected $table = 'usuario_sistema';
    protected  $connection = 'acesso';

    public $incrementing = false;
    public $primaryKey = ['usuarios_login','sistemas_id'];

    protected $fillable = [ 'nivel', 'usuarios_login', 'sistemas_id'];

}
