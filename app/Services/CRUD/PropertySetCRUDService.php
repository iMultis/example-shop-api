<?php

namespace App\Services\CRUD;

use App\Http\Requests\CollectionRequest;
use App\Models\PropertySet;

class PropertySetCRUDService
{
    public function index(array $options = [])
    {
        return PropertySet::latest()->paginate($options[CollectionRequest::PARAM_PER_PAGE] ?? null);
    }

    public function show(array $data)
    {
        return PropertySet::findOrFail($data['property_set']);
    }

    public function store(array $data)
    {
        return PropertySet::create($data);
    }

    public function update(array $data)
    {
        $propertySet = PropertySet::findOrFail($data['property_set']);
        $propertySet->update($data);

        return $propertySet;
    }

    public function destroy(array $data)
    {
        return PropertySet::findOrFail($data['property_set'])->delete();
    }
}
