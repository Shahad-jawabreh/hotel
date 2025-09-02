<?php

namespace App\Http\Requests;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use App\Services\Validation\ValidationExceptionHandler;
class HotelRequest extends FormRequest
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
        return [
            'name'        => 'required|string|max:255|unique:hotels,name',
            'location'    => 'required|string|max:255',
            'description' => 'required|string',
            'rating'      => 'nullable|numeric|min:0|max:5',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ];
    }
public function messages(): array
{
    return [
        'name.required'        => __('hotelValidation.required', ['attribute' => __('hotelValidation.attributes.name')]),
        'name.string'          => __('hotelValidation.string', ['attribute' => __('hotelValidation.attributes.name')]),
        'name.max'             => __('hotelValidation.max.string', ['attribute' => __('hotelValidation.attributes.name'), 'max' => 255]),

        'location.required'    => __('hotelValidation.required', ['attribute' => __('hotelValidation.attributes.location')]),
        'location.string'      => __('hotelValidation.string', ['attribute' => __('hotelValidation.attributes.location')]),
        'location.max'         => __('hotelValidation.max.string', ['attribute' => __('hotelValidation.attributes.location'), 'max' => 255]),

        'description.required' => __('hotelValidation.required', ['attribute' => __('hotelValidation.attributes.description')]),
        'description.string'   => __('hotelValidation.string', ['attribute' => __('hotelValidation.attributes.description')]),
        'image.image'          => __('hotelValidation.image_image') ?? 'يجب أن تكون صورة.',
        'image.mimes'          => __('hotelValidation.image_mimes') ?? 'نوع الصورة غير مسموح.',
        'image.max'            => __('hotelValidation.image_max') ?? 'حجم الصورة كبير جداً.',
    ];
}


    protected function failedValidation(Validator $validator)
    {
        ValidationExceptionHandler::handle($validator);
    }
}
