<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */

    public function rules(): array
    {
        $id = $this->route('id');
        return [
            'name' => 'required|alpha|min:3',
            'sex' => 'required|alpha',
            'phone' => 'required|phone|unique:clients,phone,'.$id, //использовал библиотеку
            'address' => 'required|alpha|min:3',
        ];
    }
}
