<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTypeRequest;
use App\Http\Requests\UpdateTypeRequest;
use App\Models\Type;
use Illuminate\Support\Str;


class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $types = Type::all();

        return view('admin.types.index', compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = Type::all();
        return view('admin.types.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTypeRequest $request)
    {
        $data = $request->validated();
        
        $type = new Type();
        $type->title = $data['title'];
        $type->slug = Str::of($type->title)->slug();

        $type->save();

        return redirect()->route('admin.types.index')->with(['message' => 'New Type created!', 'notification_type' => 'success']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Type $type)
    {
        $projects = $type->projects;

        return view('admin.types.show', compact('type', 'projects'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Type $type)
    {
        $types = Type::all();

        return view('admin.types.edit', compact('type'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTypeRequest $request, Type $type)
    {
        $data = $request->validated();
        
        $type->title = $data['title'];
        $type->slug = Str::of($type->title)->slug();

        $type->save();

        return redirect()->route('admin.types.index')->with(['message' => 'Type updated!', 'notification_type' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Type $type)
    {
        // $type->projects()->detach();
        $type_id = $type->id;
        $type->delete();
        return redirect()->route('admin.types.index')->with(['message' => "Type # $type_id - $type->title deleted!", 'notification_type' => 'danger']);
    }
}
