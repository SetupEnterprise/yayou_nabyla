<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GerantFormRequest extends FormRequest
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
            'login' => 'required',
            'nom' => 'required',
            'prenom' => 'required',
            'passwd' => 'required',
            'passwd_confirmation' => 'required',
        ];
    }

    public function messages(){
        return [
            'nom.required' => 'vous devez saisir un nom',
            'prenom.required' => 'vous devez saisir le matricule',
            'passwd.required' => 'vous devez saisir un mot de passe',
            'passwd_confirmation.required' => "Vous devez confirmer le mot de passe",
            //'passwd_confirmation.confirmed' => "le mot de passe n'est pas conforme"
        ];
    }
}
