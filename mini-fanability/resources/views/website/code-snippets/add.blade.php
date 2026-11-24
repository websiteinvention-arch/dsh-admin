@extends('website.layout.layout')

@section('content')

<div class="content-wrapper">
    <section class="content pt-5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Add New Code Snippet</h3>
                        </div>

                        <form action="{{ route('website.code-snippets.store') }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="form-group col-lg-5">
                                    <label>Snippet Name</label>
                                    <input type="text" name="name" class="form-control" placeholder="e.g. Header" value="{{ old('name') }}" required>
                                </div>

                                <div class="form-group col-lg-5">
                                    <label>Slug</label>
                                    <input type="text" name="slug" class="form-control" placeholder="e.g. header" value="{{ old('slug') }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="snippet_code">Code</label>
                                    <textarea name="code" id="" cols="30" class="form-control" rows="10"></textarea>
                                    
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-dark">Save</button>
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