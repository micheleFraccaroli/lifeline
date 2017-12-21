<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class validations extends FormRequest
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

    /* nel metodo rules vengono definiti una serie di regole che 
    i dati inviati al server devono rispettare al fine di essere convalidati e inviati al db */

    public function rules()
    {

        $uri = $this->path(); /*es: $uri = groups/create */

        $first_segment = str_before($uri,'/'); /* $first_segment = groups */

        switch($first_segment){

            case 'groups':
            {
                return [
                    'name_group' => 'bail|required|min:10|max:50',
                    'description_group' => 'bail|required|min:15|max:250',
                ];
            }

            default: return[];
        }
    }

    /* il metodo messages ritorna una serie di messaggi indicanti il tipo di errore
     che l'utente sta commettendo */

    public function messages()
    {

        $uri = $this->path();

        $first_segment = str_before($uri,'/');

        switch($first_segment){

            case 'groups':
            {
                return [
                    'name_group.required' => 'Il campo Nome Gruppo è obbligatorio.',
                    'name_group.max' => 'Il campo Nome Gruppo può contenere al massimo 50 caratteri.',
                    'name_group.min' => 'Il campo Nome Gruppo deve contenere minimo 10 caratteri.',
                    'description_group.required' => 'Il campo Descrizione è obbligatorio.',
                    'description_group.max' => 'Il campo Descrizione può contenere al massimo 250 caratteri.',
                    'description_group.min' => 'Il campo Descrizione deve contenere minimo 20 caratteri.',
                ];
            }

            default: return[];
        }
    }
}