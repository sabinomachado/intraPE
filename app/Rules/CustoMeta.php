<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Request;
use App\Models\Objetivo;
use App\Models\Meta;

class CustoMeta implements Rule
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
        $metas = Meta::where('objetivo_id', '=', $objetivoId)
            ->where('meta_id', '<>', $metaId)
            ->get();

        $somaMetas = 0;
        foreach($metas as $meta){
            $somaMetas += $meta->custo;

        }

        $somaMetas += Request::input('custo');

        if($somaMetas <= $objetivo->custo_objetivo)
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
