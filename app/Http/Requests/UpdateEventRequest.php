<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEventRequest extends FormRequest
{
    /**
     * The route is guarded by the auth + admin middleware.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, array<int, string>>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'poster_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'start_date' => ['required', 'date_format:Y-m-d\TH:i'],
            'end_date' => ['nullable', 'date_format:Y-m-d\TH:i', 'after:start_date'],
            'registration_deadline' => ['nullable', 'date', 'before:start_date'],
            'price' => ['nullable', 'numeric', 'min:0'],
            'location' => ['nullable', 'string', 'max:255'],
        ];
    }
}
