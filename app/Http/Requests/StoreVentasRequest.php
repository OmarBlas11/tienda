<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVentasRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id_product'=>'required',
            'cantidad_product'=> 'required',
            'subtotal_product'=>'required',
            'total'=>'required',
            'table_id'=>'required',
            'pago'=> 'required'
        ];
    }
    public function messages()
    {
        return [
            'id_product.required' => 'Debe seleccionar por lo menos un producto',
            'cantidad_product.required' => 'Debe Ingresar una cantidad',
            'subtotal_product.required' => 'El sub total no debe quedar vacio',
            'total.required' => 'El total no debe quedar vacio',
            'table_id.required' => 'Debe selecionar una mesa',
            'pago.required' => 'debe ingresar un monto en el pago'
        ];
    }
}
