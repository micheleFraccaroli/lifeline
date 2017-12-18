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

        $uri = $this->is();

        switch($uri){

            case 'groups':
            {
                return [
                    'name_group' => 'bail|required|max:50',
                    'description_group' => 'bail|required|max:250',
                ];
            }

            case 'groups/*';
            {

                return [
                    'name_group' => 'bail|required|max:50',
                    'description_group' => 'bail|required|max:250',
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
        $segment = $uri->segment(1);

        switch($segment){

            case 'groups':
            {
                return [
                    'name_group.required' => 'Il nome del gruppo è obbligatorio.',
                    'description_group.required' => 'La descrizione è obbligatoria.',
                ];
            }

            default: return[];
        }
    }
}