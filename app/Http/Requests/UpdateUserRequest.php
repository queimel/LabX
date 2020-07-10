<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string', 'email', 'max:255',
                Rule::unique('users')->ignore($this->route('usuario'))
            ],
            'active' => 'required'
        ];

        if ($this->request->has('run_tecnico')) {
            $rules['run_tecnico'] = 'required|cl_rut';
        }

        if ($this->request->has('telefonos_tecnico')) {
            $rules['telefonos_tecnico.*'] = 'required|regex:/^(\+?56)?(\s?)(0?9)(\s?)[9876543]\d{7}$/';
        }
        if ($this->request->has('telefonos_tecnico_id')) {
            $rules['telefonos_tecnico_id.*'] = 'required';
        }

        if( $this->filled('password'))
        {
            $rules['password'] = ['required', 'confirmed', 'regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/'];
        }
        return $rules;
    }
}
