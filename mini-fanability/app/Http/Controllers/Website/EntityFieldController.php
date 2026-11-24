<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Entity;
use App\Models\EntityField;

class EntityFieldController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | List Fields
    |--------------------------------------------------------------------------
    */

    public function index($entityId)
    {
        $entity = Entity::where('website_id', session('website_id'))
            ->findOrFail($entityId);

        $fields = EntityField::where('entity_id', $entityId)
            ->orderBy('sort_order', 'asc')
            ->get();

        return view('website.entity-fields.index', compact('entity', 'fields'));
    }

    public function add($entityId)
{
        $entity = Entity::where('website_id', session('website_id'))
            ->findOrFail($entityId);

    return view('website.entity-fields.add', compact('entity'));
}

public function store(Request $request, $entityId)
{
    Entity::where('website_id', session('website_id'))
        ->findOrFail($entityId);

    $request->validate([
        'field_name' => 'required',
        'field_type' => 'required',
    ]);

    EntityField::create([
        'entity_id'   => $entityId,
        'field_name'  => $request->field_name,
        'field_type'  => $request->field_type,
        'is_required' => $request->is_required ?? 0,
        'sort_order'  => $request->sort_order ?? 0,
        'status'      => 1,
    ]);

    return redirect()->route('website.entity-fields', $entityId)
        ->with('success', 'Field added successfully');
}

/*
|--------------------------------------------------------------------------
| Edit Field
|--------------------------------------------------------------------------
*/

public function edit($entityId, $fieldId)
{
    $entity = Entity::where('website_id', session('website_id'))
        ->findOrFail($entityId);

    $field = EntityField::where('entity_id', $entityId)
        ->where('id', $fieldId)
        ->firstOrFail();

    return view('website.entity-fields.edit', compact('entity', 'field'));
}

/*
|--------------------------------------------------------------------------
| Update Field
|--------------------------------------------------------------------------
*/

public function update(Request $request, $entityId, $fieldId)
{
    Entity::where('website_id', session('website_id'))
        ->findOrFail($entityId);

    $request->validate([
        'field_name' => 'required',
        'field_type' => 'required',
    ]);

    $field = EntityField::where('entity_id', $entityId)
        ->where('id', $fieldId)
        ->firstOrFail();

    $field->update([
        'field_name'  => $request->field_name,
        'field_type'  => $request->field_type,
        'is_required' => $request->is_required ?? 0,
        'sort_order'  => $request->sort_order ?? 0,
        'status'      => $request->status,
    ]);

    return redirect()->route('website.entity-fields', $entityId)
        ->with('success', 'Field updated successfully.');
}

/*
|--------------------------------------------------------------------------
| Delete Field
|--------------------------------------------------------------------------
*/

public function destroy($entityId, $fieldId)
{
    Entity::where('website_id', session('website_id'))
        ->findOrFail($entityId);

    $field = EntityField::where('entity_id', $entityId)
        ->where('id', $fieldId)
        ->firstOrFail();

    $field->delete();

    return redirect()->back()
        ->with('success', 'Field deleted successfully.');
}




}