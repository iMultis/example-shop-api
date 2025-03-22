<?php

namespace App\Http\Requests\PropertySet\Property;

class PropertyUpdateRequest extends PropertyRequest
{
    public function rules(): array
    {
        return parent::rules() + [
            'name' => ['string', 'max:255'],
        ];
    }
}
