<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CarUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
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
            'brand' => 'alpha|required',
            'model' => 'required',
            'color' => 'required',
            'plate' => ['required', 'unique:cars,plate,'.$this->id ,
                'regex:/^[АВЕКМНОРСТУХ]\d{3}(?<!000)[АВЕКМНОРСТУХ]{2}\d{2,3}$/ui'],
            'in_parking' => '',
        ];
    }
}
