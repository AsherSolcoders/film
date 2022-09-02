<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FilmRequest extends FormRequest
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
            'name' => 'required|max:255',
            'release_date' => 'required|date_format:Y-m-d',
            'rating' => 'required',
            'genres' => 'required|array|min:1',
            'country' => 'required',
            'ticket' => 'required',
            'description' => 'required',
            'photo' => 'required|image|mimes:jpeg,bmp,png',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Name is required',
            'release_date.required' => 'Release Date is required',
            'rating.required' => 'Rating is required',
            'country.required' => 'Country is required',
            'ticket.required' => 'Ticket is required',
            'photo.required' => 'photo is required',
            'description.image' => 'photo is required',
            'genres.required' => 'Select atleast one genres',
        ];
    }
}
