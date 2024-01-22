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
    private $id;

    public function __construct($id)
    {
        $this->id = $id;
    }
    public function rules(): array
    {
        return [
            'name' => 'min:3',
            'sex' => 'required',
            'phone' => 'required|phone|unique:clients,phone,'.$this->id, //использовал библиотеку
            'address' => '',
        ];
    }
}
