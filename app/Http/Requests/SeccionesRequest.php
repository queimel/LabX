<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use App\Cliente;

class SeccionesRequest extends FormRequest
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
            'parent_id' => ['required'],
            'nombre_cliente' => ['required', 'string', 'max:255'],
            'rut_cliente' => ['required', 'cl_rut'],
            'descripcion_cliente' => 'string',
            'direccion_cliente' => ['required', 'string', 'max:255'],
            'id_comuna' => 'required'
        ];
    }

    protected function getRedirectUrl()
    {

        $post = $this->route()->parameter('seccione');

        if($post){
            return route('admin.secciones.edit', $post);
        }else{
            $sucursal = Cliente::find($this->request->get('parent_id'));
            
            return route('admin.secciones.create', $sucursal);
        }
    }
}
