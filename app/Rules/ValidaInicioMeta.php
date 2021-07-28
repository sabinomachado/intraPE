<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Request;
use App\Models\Objetivo;
use App\Models\Meta;


class ValidaInicioMeta implements Rule
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
        $objetivoId = Request::input('objetivo_id');
        $metaId = Request::input('meta_id');
        $objetivo = Objetivo::find($objetivoId);
        $dataFim = Request::input('data_inicio_previsto');

        if($objetivo->data_fim >= $dataFim){
            return true;
        }else{
            $this->text ='O campo data início previsto deve ser uma data inferior ou igual ao fim do Objetivo.';
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
