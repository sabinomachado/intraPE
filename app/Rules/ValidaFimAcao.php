<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Request;
use App\Models\Acao;
use App\Models\Meta;

class ValidaFimAcao implements Rule
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
        $acao_id = Request::input('acao_id');
        $meta = Meta::find($metaId);
        $dataFim = Request::input('data_fim_previsto');

        if($meta->data_fim_previsto >= $dataFim){
            return true;
        }else{
            $this->text ='O campo deve ser uma data inferior ou igual ao fim da Meta.';
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
