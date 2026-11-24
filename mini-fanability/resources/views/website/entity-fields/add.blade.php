@extends('website.layout.layout')

@section('content')

<div class="content-wrapper">
    <section class="content pt-5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Add Field to {{ $entity->name }}</h3>
                        </div>

                        <form action="{{ route('website.entity-fields.store', $entity->id) }}" method="POST">
                            @csrf

                            <div class="card-body">
                                <div class="form-group col-lg-5">
                                    <label for="field_name">Field Name</label>
                                    <input type="text"
                                           id="field_name"
                                           name="field_name"
                                           class="form-control"
                                           value="{{ old('field_name') }}"
                                           placeholder="e.g. Title"
                                           required>
                                </div>

                                <div class="form-group col-lg-5">
                                    <label for="field_type">Field Type</label>
                                    <select id="field_type" name="field_type" class="form-control" required>
                                        <option value="text" {{ old('field_type', 'text') == 'text' ? 'selected' : '' }}>Text</option>
                                        <option value="textarea" {{ old('field_type') == 'textarea' ? 'selected' : '' }}>Textarea</option>
                                        <option value="number" {{ old('field_type') == 'number' ? 'selected' : '' }}>Number</option>
                                        <option value="file" {{ old('field_type') == 'file' ? 'selected' : '' }}>File</option>
                                        <option value="date" {{ old('field_type') == 'date' ? 'selected' : '' }}>Date</option>
                                        <option value="select" {{ old('field_type') == 'select' ? 'selected' : '' }}>Select</option>
                                    </select>
                                </div>

                                <div class="form-group col-lg-5">
                                    <label for="is_required">Required?</label>
                                    <select id="is_required" name="is_required" class="form-control">
                                        <option value="0" {{ old('is_required', '0') == '0' ? 'selected' : '' }}>No</option>
                                        <option value="1" {{ old('is_required') == '1' ? 'selected' : '' }}>Yes</option>
                                    </select>
                                </div>

                                <div class="form-group col-lg-5">
                                    <label for="sort_order">Sort Order</label>
                                    <input type="number"
                                           id="sort_order"
                                           name="sort_order"
                                           class="form-control"
                                           value="{{ old('sort_order', 0) }}">
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-dark">Save</button>
                                <button type="button" class="btn btn-success">Save &amp; Resume</button>
                                <a href="{{ route('website.entity-fields', $entity->id) }}" class="btn btn-warning">Close</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection
