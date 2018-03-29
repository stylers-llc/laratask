<?php

namespace Stylers\Laratask\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Stylers\Laratask\Rules\DateDiffGreaterOrEqual;
use Stylers\Laratask\Rules\IsDateInterval;

class StoreTaskTemplateRuntime extends FormRequest
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
            'start_at' => 'required|date',
            'end_at' => 'date|after:start_at',
            'date_interval' => [
                new IsDateInterval(),
                new DateDiffGreaterOrEqual(
                    Carbon::parse($this->start_at),
                    $this->end_at ? Carbon::parse($this->end_at) : null
                )
            ],
        ];
    }
}
