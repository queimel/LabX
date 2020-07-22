<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SucursalesRequest extends FormRequest
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
            'nombre_cliente' => ['required', 'string', 'max:255'],
            'rut_cliente' => ['required', 'cl_rut'],
            'descripcion_cliente' => 'string',
            'direccion_cliente' => ['required', 'string', 'max:255'],
            'id_comuna' => 'required'
        ];
    }

    protected function getRedirectUrl()
    {
        $post = $this->route()->parameter('sucursale');
        
        if($post){
            return route('admin.sucursales.edit', $post);
        }else{
            return route('admin.sucursales.create');
        }
    }
}
