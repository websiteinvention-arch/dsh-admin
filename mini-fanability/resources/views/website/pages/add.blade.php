@extends('website.layout.layout')

@section('content')
<div class="content-wrapper">
    <section class="content pt-5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Add New Page</h3>
                        </div>

                        <form action="{{ route('website.pages.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group col-lg-5">
                                    <label>Page Name <span class="badge badge-info">[page field=page_name]</span></label>
                                    <input type="text" name="page_name" class="form-control" value="{{ old('page_name') }}" required>
                                </div>

                                <div class="form-group col-lg-5">
                                    <label>Slug <span class="badge badge-info">[page field=slug]</span></label>
                                    <input type="text" name="slug" class="form-control" value="{{ old('slug') }}" required>
                                </div>

                                <div class="form-group">
                                    <label>Page Content <span class="badge badge-info">[page field=page_content]</span></label>
                                    <div class="mb-2">
                                        <div class="btn-group" role="group" aria-label="Choose page content editor">
                                            <button type="button" class="btn btn-primary" id="page_content_code_tab" aria-pressed="true">Code</button>
                                            <button type="button" class="btn btn-outline-primary" id="page_content_preview_tab" aria-pressed="false">Visual preview</button>
                                        </div>
                                        <small class="form-text text-muted">Switch to Visual preview to edit text without working with HTML.</small>
                                    </div>
                                    <div id="page_content_formatting_toolbar" class="btn-toolbar mb-2 d-none" role="toolbar" aria-label="Format page content">
                                        <div class="form-inline mr-2">
                                            <label class="sr-only" for="page_content_block_format">Text style</label>
                                            <select id="page_content_block_format" class="form-control form-control-sm">
                                                <option value="">Text style</option>
                                                <option value="p">Paragraph</option>
                                                <option value="h1">Heading 1</option>
                                                <option value="h2">Heading 2</option>
                                                <option value="h3">Heading 3</option>
                                                <option value="h4">Heading 4</option>
                                                <option value="h5">Heading 5</option>
                                                <option value="h6">Heading 6</option>
                                            </select>
                                        </div>
                                        <div class="btn-group btn-group-sm" role="group" aria-label="Lists">
                                            <button type="button" class="btn btn-outline-secondary" id="page_content_bulleted_list">Bulleted list</button>
                                            <button type="button" class="btn btn-outline-secondary" id="page_content_numbered_list">Numbered list</button>
                                        </div>
                                        <div class="btn-group btn-group-sm ml-2" role="group" aria-label="Text formatting">
                                            <button type="button" class="btn btn-outline-secondary" id="page_content_bold" aria-label="Bold" title="Bold"><strong>B</strong></button>
                                            <button type="button" class="btn btn-outline-secondary" id="page_content_italic" aria-label="Italic" title="Italic"><em>I</em></button>
                                            <button type="button" class="btn btn-outline-secondary" id="page_content_underline" aria-label="Underline" title="Underline"><u>U</u></button>
                                            <button type="button" class="btn btn-outline-secondary" id="page_content_strikethrough" aria-label="Strikethrough" title="Strikethrough"><s>S</s></button>
                                            <button type="button" class="btn btn-outline-secondary" id="page_content_link" aria-label="Insert link" title="Insert link">Link</button>
                                            <button type="button" class="btn btn-outline-secondary" id="page_content_unlink" aria-label="Remove link" title="Remove link">Unlink</button>
                                        </div>
                                        <label class="form-control form-control-sm ml-2 mb-0 d-inline-flex align-items-center" for="page_content_text_color" title="Text color">
                                            Text color
                                            <input type="color" id="page_content_text_color" class="ml-1 border-0 p-0" aria-label="Text color">
                                        </label>
                                    </div>
                                    <textarea name="page_content" id="page_content_source" class="form-control" rows="10">{{ old('page_content') }}</textarea>
                                    <div id="page_content_editor"></div>
                                    <iframe id="page_content_preview" class="d-none" title="Editable visual preview of page content" sandbox="allow-same-origin" referrerpolicy="no-referrer"></iframe>
                                    <div id="page_content_preview_error" class="text-danger mt-2" role="alert" hidden></div>
                                </div>

                                <div class="form-group col-lg-5">
                                    <label>Browser Title <span class="badge badge-info">[page field=browser_title]</span></label>
                                    <input type="text" name="browser_title" class="form-control" value="{{ old('browser_title') }}" placeholder="Browser title">
                                </div>

                                <div class="form-group col-lg-5">
                                    <label>Meta Keywords <span class="badge badge-info">[page field=meta_keywords]</span></label>
                                    <input type="text" name="meta_keywords" class="form-control" value="{{ old('meta_keywords') }}" placeholder="keyword1, keyword2, keyword3">
                                </div>

                                <div class="form-group col-lg-5">
                                    <label>Meta Description <span class="badge badge-info">[page field=meta_description]</span></label>
                                    <input type="text" name="meta_description" class="form-control" value="{{ old('meta_description') }}" placeholder="Meta Description">
                                </div>

                                <div class="form-group col-lg-5">
                                    <label>Page Keyword <span class="badge badge-info">[page field=page_keyword]</span></label>
                                    <input type="text" name="page_keyword" class="form-control" value="{{ old('page_keyword') }}" placeholder="Page keyword">
                                </div>

                                <div class="form-group col-lg-5">
                                    <label>Page Image <span class="badge badge-info">[page field=page_image]</span></label>
                                    <input type="text" name="page_image" value="{{ old('page_image') }}" placeholder="Page Image" class="form-control">
                                </div>

                                <div class="form-group col-lg-5">
                                    <label>Text Variable <span class="badge badge-info">[page field=text_variable]</span></label>
                                    <input type="text" name="text_variable" value="{{ old('text_variable') }}" placeholder="Text Variable" class="form-control">
                                </div>

                                <div class="form-group col-lg-5">
                                    <label>Include in Head <span class="badge badge-info">[page field=include_in_head]</span></label>
                                    <textarea name="include_in_head" class="form-control" rows="5" placeholder="Code to include in head">{{ old('include_in_head') }}</textarea>
                                </div>

                                <div class="form-group col-lg-5">
                                    <label>Include in Footer <span class="badge badge-info">[page field=include_in_footer]</span></label>
                                    <textarea name="include_in_footer" class="form-control" rows="5" placeholder="Code to include in footer">{{ old('include_in_footer') }}</textarea>
                                </div>

                                <div class="form-group col-lg-5">
                                    <label>Template File</label>
                                    <input type="text" name="template_file" class="form-control" id="page_template_file" value="{{ old('template_file') }}" placeholder="Template file">
                                </div>

                                <div class="form-group col-lg-5">
                                    <label>Status</label>
                                    <select name="status" class="form-control">
                                        <option value="1" {{ old('status', 1) == 1 ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ old('status', 1) == 0 ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-dark">Save</button>
                                <button type="submit" class="btn btn-success">Save &amp; Resume</button>
                                <a href="{{ route('website.pages') }}" class="btn btn-warning">Close</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

