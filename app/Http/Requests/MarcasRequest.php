<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use App\Marca;

class MarcasRequest extends FormRequest
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
            'nombre_marca' => ['required', 'string', 'max:255'],
            'origen_marca' => 'required'
        ];
    }

    protected function getRedirectUrl()
    {

        $marca = $this->route()->parameter('marca');

        if($marca){
            return route('admin.marcas.edit', $marca);
        }else{
            return route('admin.marcas.create');
        }
    }
}
