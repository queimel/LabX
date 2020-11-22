<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use App\Marca;

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

        $rules = [
            'id_tecnico_mantenimiento' => 'required',
            'id_equipo_mantenimiento' => 'required'
        ];

        if ($this->request->has('status')) {
            $rules['status'] = 'required';
        }

        if ($this->request->has('log_mantenimiento')) {
            $rules['log_mantenimiento'] = 'required';
        }

        return $rules;
    }

    protected function getRedirectUrl()
    {

        
        $mantenimiento = $this->route()->parameter('mantenimientos_tecnico');
        if( $mantenimiento){
            return route('admin.mantenimientos-tecnico.edit', $mantenimiento);
        }else{
            return route('admin.mantenimientos-tecnico.create');
        }
    }
}
