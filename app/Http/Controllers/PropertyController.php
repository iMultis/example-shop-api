<?php

namespace App\Http\Controllers;

use App\Http\Requests\PropertySet\Property\PropertyIndexRequest;
use App\Http\Requests\PropertySet\Property\PropertyRequest;
use App\Http\Requests\PropertySet\Property\PropertyStoreRequest;
use App\Http\Requests\PropertySet\Property\PropertyUpdateRequest;
use App\Http\Responses\Response;
use App\Services\CRUD\PropertyCRUDService;

class PropertyController extends Controller
{
    public function __construct(protected PropertyCRUDService $service)
    {
    }

    public function index(PropertyIndexRequest $request)
    {
        return $this->service->index($request->validated() );
    }

    public function show(PropertyRequest $request)
    {
        return $this->service->show($request->validated());
    }

    public function store(PropertyStoreRequest $request)
    {
        return $this->service->store($request->validated());
    }


    public function update(PropertyUpdateRequest $request)
    {
        return $this->service->update($request->validated());
    }

    public function destroy(PropertyRequest $request)
    {
        $this->service->destroy($request->validated());

        return new Response(status: Response::HTTP_NO_CONTENT);
    }
}
