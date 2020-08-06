<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MantenimientosRequest extends FormRequest
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
            'id_tecnico_mantenimiento' => 'required',
            'id_equipo_mantenimiento' => 'required',
            'fecha_mantenimiento' => ['required', 'date']
        ];
    }
    public function messages()
    {
        return [
            'id_tecnico_mantenimiento.required' => 'Debe seleccionar un tecnico',
            'fecha_mantenimiento.required' => 'Debe ingresar una fecha'
        ];
    }

    protected function getRedirectUrl()
    {
        $mantenimiento = $this->route()->parameter('mantenimiento');
        
        if($mantenimiento){
            return route('admin.mantenimientos.edit', $mantenimiento);
        }else{
            return route('admin.mantenimientos.create');
        }
    }
}
