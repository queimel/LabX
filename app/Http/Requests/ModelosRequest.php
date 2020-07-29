<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use App\Marca;

class ModelosRequest extends FormRequest
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
            'id_marca_modelo' => 'required',
            'nombre_modelo' => ['required', 'string', 'max:255'],
            'descripcion_modelo' => ['required', 'string', 'max:255'],
            'frecuencia_modelo' => ['required', 'integer', 'min:0']
        ];
    }

    protected function getRedirectUrl()
    {

        $modelo = $this->route()->parameter('modelo');
        $method = $this->request->get('_method');

        if($method === 'PUT'){
            return route('admin.modelos.edit', $modelo);
        }else{
            $marca = Marca::find($this->request->get('id_marca_modelo'));
            return route('admin.modelos.create', $marca);
        }
    }
}
