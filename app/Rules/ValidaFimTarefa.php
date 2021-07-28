<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Request;
use App\Acao;
use App\Models\Tarefa;


class ValidaFimTarefa implements Rule
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
        $acaoId = Request::input('acao_id');
        $tarefaId = Request::input('tarefa_id');
        $acao = Acao::find($acaoId);
        $dataFim = Request::input('data_fim_previsto');

        if($acao->data_fim_previsto >= $dataFim){
            return true;
        }else{
            $this->text ='O campo data fim previsto deve ser uma data inferior ou igual ao fim da Ação.';
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
        return  $this->text;
    }
}
