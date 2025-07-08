<?php

namespace App\Http\Controllers\Admin;

use App\Enums\Param\ParamFilterTypeEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Param\StoreRequest;
use App\Http\Requests\Admin\Param\UpdateRequest;
use App\Http\Resources\Param\ParamResource;
use App\Models\Param;
use App\Services\ParamService;
use Illuminate\Http\Request;

class ParamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $params = Param::all();
        $params = ParamResource::collection($params)->resolve();
//        dd($params);
        return inertia('Admin/Param/Index', compact('params'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $filterTypes= ParamFilterTypeEnum::collection();
        return inertia('Admin/Param/Create', compact('filterTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        $param = ParamService::store($data);
        return ParamResource::make($param)->resolve();
    }

    /**
     * Display the specified resource.
     */
    public function show(Param $param)
    {
        $param = ParamResource::make($param)->resolve();
        return inertia('Admin/Param/Show', compact('param'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Param $param)
    {
        $filterTypes= ParamFilterTypeEnum::collection();
        $param = ParamResource::make($param)->resolve();
        return inertia('Admin/Param/Edit', compact('param', 'filterTypes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Param $param)
    {
        $data = $request->validated();
        $param = ParamService::update($param, $data);
        return ParamResource::make($param)->resolve();
    }

    public function destroy(Param $param)
    {
        $param->delete();
        return response()->json([
            'message' => 'Param deleted successfully'
        ], \Illuminate\Http\Response::HTTP_OK);
    }
}
