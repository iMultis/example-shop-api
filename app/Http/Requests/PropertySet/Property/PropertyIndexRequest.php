<?php

namespace App\Http\Requests\PropertySet\Property;

use App\Http\Requests\CollectionRequest;

class PropertyIndexRequest extends CollectionRequest
{
    public function rules(): array
    {
        return [
            'property_set' => ['required', 'integer'],
        ];
    }
}
