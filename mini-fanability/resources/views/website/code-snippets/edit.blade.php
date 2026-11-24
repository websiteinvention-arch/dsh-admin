@extends('website.layout.layout')

@section('content')

<div class="content-wrapper">
    <section class="content pt-5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Edit Code Snippet</h3>
                        </div>

                        <form action="{{ route('website.code-snippets.update', $snippet->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="card-body">
                                <div class="form-group col-lg-5">
                                    <label>Snippet Name</label>
                                    <input type="text" name="name" class="form-control" value="{{ old('name', $snippet->name) }}" placeholder="e.g. Header" required>
                                </div>

                                <div class="form-group col-lg-5">
                                    <label>Slug</label>
                                    <input type="text" name="slug" class="form-control" value="{{ old('slug', $snippet->slug) }}" placeholder="e.g. header" required>
                                </div>

                                <div class="form-group">
                                    <label for="snippet_code">Code</label>
                                    <textarea name="code" id="" class="form-control" cols="30" rows="10">{{ old('code', $snippet->code) }}</textarea>
                                    
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-dark">Update</button>
                                <button type="button" class="btn btn-success">Save &amp; Resume</button>
                                <a href="{{ route('website.code-snippets') }}" class="btn btn-warning">Close</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection