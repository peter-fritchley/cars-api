<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCarRequest extends FormRequest
{
    /**
     * @return array
     */
    public function rules()
    {
        $fourYearsAgo = new \DateTime('-4 years');

        return [
            'make' => ['required', 'max:64'],
            'model' => ['required', 'max:128'],
            'build_date' => ['required', 'date_format:Y-m-d', sprintf('after:%s', $fourYearsAgo->format('Y-m-d'))],
            'colour_id' => ['required', 'exists:colours,id']
        ];
    }
}