<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Employe;
use App\Http\Requests\StoreEmployeRequest;
use App\Http\Requests\UpdateEmployeRequest;
use App\Http\Resources\EmployeResource;

class EmployeController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $employe = Employe::query()->orderBy('id', 'desc')->paginate(10);
        return EmployeResource::collection($employe);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEmployeRequest $request)
    {
        $data = $request->validated();
        $data['handicape'] = !empty($employe['handicape']) ? $employe['handicape'] : false;

        $employe = Employe::create($data);
        return new EmployeResource($employe);
    }

    /**
     * Display the specified resource.
     */
    public function show(Employe $employe)
    {
        return new EmployeResource($employe);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmployeRequest $request, Employe $employe)
    {
        $data = $request->validated();
        $employe->update($data);
        return new EmployeResource($employe);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employe $employe)
    {
        $employe->delete();
        return response()->json(['message' => 'Employee deleted successfully']);
    }
}
