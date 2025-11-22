<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductoRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        $producto = $this->route('producto');
        return [
            'codigo' => 'nullable|unique:productos,codigo,'.$producto->id.'|max:50',
            'nombre' => 'required|unique:productos,nombre,'.$producto->id.'|max:255',
            'descripcion' => 'nullable|max:255',
            'img_path' => [
                'nullable',
                'file',
                'max:2048',
                function ($attribute, $value, $fail) {
                    $extension = strtolower($value->getClientOriginalExtension());
                    $allowed = ['avif', 'webp', 'jpeg', 'jpg', 'png'];
                    if (!in_array($extension, $allowed)) {
                        $fail('La imagen debe tener una de las siguientes extensiones: ' . implode(', ', $allowed));
                    }
                }
            ],
            'images.*' => [
                'nullable',
                'file',
                'max:2048',
                function ($attribute, $value, $fail) {
                    $extension = strtolower($value->getClientOriginalExtension());
                    $allowed = ['avif', 'webp', 'jpeg', 'jpg', 'png'];
                    if (!in_array($extension, $allowed)) {
                        $fail('La imagen debe tener una de las siguientes extensiones: ' . implode(', ', $allowed));
                    }
                }
            ],
            'videos.*' => 'nullable|mimes:mp4,mov,ogg,qt|max:20000',
            'marca_id' => 'nullable|integer|exists:marcas,id',
            'presentacione_id' => 'required|integer|exists:presentaciones,id',
            'categoria_id' => 'nullable|integer|exists:categorias,id'
        ];
    }

    public function attributes()
    {
        return [
            'marca_id' => 'marca',
            'presentacione_id' => 'presentación',
            'categoria_id' => 'categoria'
        ];
    }

    public function messages()
    {
        return [
            //'codigo.required' => 'Se necesita un campo código'
        ];
    }
}
