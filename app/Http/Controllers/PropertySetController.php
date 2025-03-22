<?php

namespace App\Http\Controllers;

use App\Http\Requests\PropertySet\PropertySetIndexRequest;
use App\Http\Requests\PropertySet\PropertySetRequest;
use App\Http\Requests\PropertySet\PropertySetStoreRequest;
use App\Http\Requests\PropertySet\PropertySetUpdateRequest;
use App\Http\Responses\Response;
use App\Services\CRUD\PropertySetCRUDService;

class PropertySetController extends Controller
{
    public function __construct(protected PropertySetCRUDService $service)
    {
    }

    public function index(PropertySetIndexRequest $request)
    {
        return $this->service->index($request->validated());
    }

    public function show(PropertySetRequest $request)
    {
        return $this->service->show($request->validated());
    }

    public function store(PropertySetStoreRequest $request)
    {
        return $this->service->store($request->validated());
    }

    public function update(PropertySetUpdateRequest $request)
    {
        return $this->service->update($request->validated());
    }

    public function destroy(PropertySetRequest $request)
    {
        $this->service->destroy($request->validated());

        return new Response(status: Response::HTTP_NO_CONTENT);
    }
}
