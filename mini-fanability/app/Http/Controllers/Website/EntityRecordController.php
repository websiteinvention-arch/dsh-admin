<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Entity;
use App\Models\EntityRecord;
use App\Models\EntityField;
use App\Models\EntityRecordValue;
class EntityRecordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | List Records
    |--------------------------------------------------------------------------
    */

    public function index($entityId)
    {
        $entity = Entity::where('website_id', session('website_id'))
            ->findOrFail($entityId);

        $records = EntityRecord::with('values')
    ->where('entity_id', $entityId)
    ->latest()
    ->get();

        $fields = EntityField::where('entity_id', $entityId)
            ->where('status', 1)
            ->orderBy('sort_order')
            ->get();

        return view('website.entity-records.index', compact(
            'entity',
            'records',
            'fields'
        ));
    }


    /*
    |--------------------------------------------------------------------------
    | Add Record Form
    |--------------------------------------------------------------------------
    */

    public function add($entityId)
    {
        $entity = Entity::where('website_id', session('website_id'))
            ->findOrFail($entityId);

        $fields = EntityField::where('entity_id', $entityId)
            ->where('status', 1)
            ->orderBy('sort_order')
            ->get();

        return view('website.entity-records.add', compact(
            'entity',
            'fields'
        ));
    }

    /*
|--------------------------------------------------------------------------
| Store Record
|--------------------------------------------------------------------------
*/

public function store(Request $request, $entityId)
{
    $entity = Entity::where('website_id', session('website_id'))
        ->findOrFail($entityId);

    $fields = EntityField::where('entity_id', $entityId)
        ->where('status', 1)
        ->get();

    // Create record
    $record = EntityRecord::create([
        'entity_id' => $entityId,
    ]);

    // Save field values
    foreach ($fields as $field) {

        $value = $request->input('fields.' . $field->id);

        // Handle file
        if ($field->field_type == 'file') {

            if ($request->hasFile('fields.' . $field->id)) {

                $file = $request->file('fields.' . $field->id);

                $value = $file->store('entity-records', 'public');
            }
        }

        EntityRecordValue::create([
            'entity_record_id' => $record->id,
            'entity_field_id'  => $field->id,
            'value'            => $value,
        ]);
    }

    return redirect()
        ->route('website.entity-records', $entityId)
        ->with('success', 'Record added successfully.');
}

/*
|--------------------------------------------------------------------------
| Edit Record
|--------------------------------------------------------------------------
*/

public function edit($entityId, $recordId)
{
    $entity = Entity::where('website_id', session('website_id'))
        ->findOrFail($entityId);

    $record = EntityRecord::with('values')
        ->where('entity_id', $entityId)
        ->where('id', $recordId)
        ->firstOrFail();

    $fields = EntityField::where('entity_id', $entityId)
        ->where('status', 1)
        ->orderBy('sort_order')
        ->get();

    return view('website.entity-records.edit', compact(
        'entity',
        'record',
        'fields'
    ));
}

/*
|--------------------------------------------------------------------------
| Update Record
|--------------------------------------------------------------------------
*/

public function update(Request $request, $entityId, $recordId)
{
    $entity = Entity::where('website_id', session('website_id'))
        ->findOrFail($entityId);

    $record = EntityRecord::where('entity_id', $entityId)
        ->where('id', $recordId)
        ->firstOrFail();

    $fields = EntityField::where('entity_id', $entityId)
        ->where('status', 1)
        ->get();

    foreach ($fields as $field) {

        $value = $request->input('fields.' . $field->id);

        if ($field->field_type == 'file') {

            if ($request->hasFile('fields.' . $field->id)) {

                $file = $request->file('fields.' . $field->id);

                $value = $file->store('entity-records', 'public');
            } else {

                $oldValue = EntityRecordValue::where('entity_record_id', $record->id)
                    ->where('entity_field_id', $field->id)
                    ->first();

                $value = $oldValue ? $oldValue->value : null;
            }
        }

        EntityRecordValue::updateOrCreate(
            [
                'entity_record_id' => $record->id,
                'entity_field_id' => $field->id,
            ],
            [
                'value' => $value,
            ]
        );
    }

    return redirect()
        ->route('website.entity-records', $entityId)
        ->with('success', 'Record updated successfully.');
}


/*
|--------------------------------------------------------------------------
| Delete Record
|--------------------------------------------------------------------------
*/

public function destroy($entityId, $recordId)
{
    Entity::where('website_id', session('website_id'))
        ->findOrFail($entityId);

    $record = EntityRecord::where('entity_id', $entityId)
        ->where('id', $recordId)
        ->firstOrFail();

    $record->delete();

    return redirect()
        ->route('website.entity-records', $entityId)
        ->with('success', 'Record deleted successfully.');
}


}