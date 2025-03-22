<?php

namespace App\Services\CRUD;

use App\Http\Requests\CollectionRequest;
use App\Models\Property;
use App\Models\PropertySet;

class PropertyCRUDService
{
    public function index(array $options = [])
    {
        $properties = Property::latest();

        if (array_key_exists('property_set', $options)) {
            $properties->where(['property_set_id' => $options['property_set']]);
        }

        return $properties->paginate($options[CollectionRequest::PARAM_PER_PAGE] ?? null);
    }

    public function show(array $data)
    {
        return Property::where(['property_set_id' => $data['property_set']])->findOrFail($data['property']);
    }

    public function store(array $data)
    {
        return PropertySet::findOrFail($data['property_set'])->properties()->create($data);
    }

    public function update(array $data)
    {
        $property = Property::findOrFail($data['property']);
        $property->update($data);

        return $property;
    }

    public function destroy(array $data)
    {
        return Property::findOrFail($data['property'])->delete();
    }
}
