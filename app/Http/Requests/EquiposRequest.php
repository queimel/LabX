<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EquiposRequest extends FormRequest
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
            'marca_equipo' => 'required',
            'id_modelo_equipo' => 'required',
            'num_serie_equipo' => ['required', 'unique:equipos'],
            'fecha_fabricacion_equipo' => ['required', 'date'],
        ];
    }

    protected function getRedirectUrl()
    {
        $equipo = $this->route()->parameter('equipo');
        
        if($equipo){
            return route('admin.equipos.edit', $equipo);
        }else{
            return route('admin.equipos.create');
        }
    }
}
