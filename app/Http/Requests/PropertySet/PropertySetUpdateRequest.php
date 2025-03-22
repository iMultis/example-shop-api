<?php

namespace App\Http\Requests\PropertySet;

class PropertySetUpdateRequest extends PropertySetRequest
{
    public function rules(): array
    {
        return parent::rules() + [
            'name' => ['string', 'max:255'],
        ];
    }
}
