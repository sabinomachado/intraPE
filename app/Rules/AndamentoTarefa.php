<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Request;
use App\Tarefa;



class AndamentoTarefa implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $tarefaId = Request::input('tarefa_id');
        $tarefa = Tarefa::find($tarefaId);
        
        $andamento = Request::input('andamento');
        if($andamento >= $tarefa->andamento)
        return true;
        else{
           $this->text = 'Selecione um andamento maior ou igual ao atual!';
           return false;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->text;
    }
}
