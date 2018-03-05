<?php

namespace Stylers\Laratask\Requests;


use Illuminate\Foundation\Http\FormRequest;
use Stylers\Laratask\Interfaces\AssignableInterface;
use Stylers\Laratask\Interfaces\TaskableInterface;
use Stylers\Laratask\Rules\ImplementsInterface;
use Stylers\Taxonomy\Models\Language;

class StoreTaskTemplate extends FormRequest
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
        $code = $this->getDefaultLanguageCode();

        return [
            'name' => 'required|array',
            'name.translations.' . $code => 'required|string',

            'assignable_type' => ['required', 'string', new ImplementsInterface(AssignableInterface::class)],
            'assignable_id' => 'required|numeric',

            'taskable_type' => ['string', new ImplementsInterface(TaskableInterface::class)],
            'taskable_id' => 'nullable|numeric',
        ];
    }

    /**
     * @return mixed
     */
    private function getDefaultLanguageCode()
    {
        return Language::getDefaultLanguageCode();
    }
}
