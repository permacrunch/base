<?php

namespace Permacrunch\Base\Controllers;

use Permacrunch\Base\Models\Company;
use Illuminate\Http\Request;

use Permacrunch\Base\Models\Entity;
use Knowfox\Crud\Services\Crud;

class EntityController extends Controller
{
    protected $crud;

    public function __construct(Crud $crud)
    {
        parent::__construct();
        $this->crud = $crud;
        $crud->setup('permacrunch.entity');
    }

    public function index(Request $request)
    {
        return $this->crud->index($request);
    }

    public function create()
    {
        return $this->crud->create();
    }

    public function store(CreateEntityRequest $request)
    {
        list($entity, $response) = $this->crud->store($request);
        return $response;
    }

    public function show(Request $request, Entity $entity)
    {
        return view(config('crud.theme') . '.entity.show', ['entity' => $entity]);
    }

    public function edit(Entity $entity)
    {
        return $this->crud->edit($entity);
    }

    public function update(UpdateEntityRequest $request, Entity $entity)
    {
        return $this->crud->update($request, $entity);
    }

    public function destroy(Entity $entity)
    {
        return $this->crud->destroy($entity);
    }
}
