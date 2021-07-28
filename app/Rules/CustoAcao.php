<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Request;
use App\Acao;
use App\Models\Meta;


class CustoAcao implements Rule
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
        $metaId = Request::input('meta_id');
        $acaoId = Request::input('acao_id');
        $meta = Meta::find($metaId);
        $acoes = Acao::where('meta_id', '=', $metaId)
            ->where('acao_id', '<>', $acaoId)
            ->get();

        $somaAcoes = 0;
        foreach($acoes as $acao){
            $somaAcoes += $acao->custo;

        }


        $somaAcoes += Request::input('custo');



        if($somaAcoes <= $meta->custo)
        return true;
        else{
           $this->text = 'Ultrapassou o Valor Orçado';
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
