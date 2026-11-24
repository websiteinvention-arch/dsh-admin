@extends('website.layout.layout')

@section('content')

<div class="content-wrapper">
    <section class="content pt-5">
        <div class="container-fluid">
            <div class="row align-items-center mb-4">
                <div class="col-sm-8">
                    <p class="text-uppercase text-muted mb-1">{{ session('website_name') }}</p>
                    <h1 class="m-0">Website Dashboard</h1>
                    <p class="text-muted mt-2 mb-0">Manage your website content and settings.</p>
                </div>
                <div class="col-sm-4 text-sm-right mt-3 mt-sm-0">
                    <form action="{{ route('website.logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-sign-out-alt mr-1"></i>
                            Logout
                        </button>
                    </form>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <h2 class="h4 mb-3">Entity Records</h2>
                </div>
                @forelse($entities as $entity)
                    <div class="col-md-6 col-xl-4">
                        <div class="card card-info h-100">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="fas fa-database mr-2"></i>{{ $entity->name }}
                                </h3>
                            </div>
                            <div class="card-body">
                                <p>View and manage records for this entity.</p>
                                <a href="{{ route('website.entity-records', $entity->id) }}" class="btn btn-primary">
                                    <i class="fas fa-list mr-1"></i>View Records
                                </a>
                                <a href="{{ route('website.entity-records.add', $entity->id) }}" class="btn btn-success">
                                    <i class="fas fa-plus mr-1"></i>Add Record
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-md-6 col-xl-4">
                        <div class="card card-info h-100">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="fas fa-database mr-2"></i>Entity Records
                                </h3>
                            </div>
                            <div class="card-body">
                                <p>No active entities yet. Add an entity to start managing records.</p>
                                <a href="{{ route('website.entities.add') }}" class="btn btn-success">
                                    <i class="fas fa-plus mr-1"></i>Add Entity
                                </a>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>

            <div class="row">
                <div class="col-md-6 col-xl-4">
                    <div class="card card-info h-100">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-file-alt mr-2"></i>Pages</h3>
                        </div>
                        <div class="card-body">
                            <p>Manage your website pages and page content.</p>
                            <a href="{{ route('website.pages') }}" class="btn btn-primary">
                                <i class="fas fa-list mr-1"></i>Manage Pages
                            </a>
                            <a href="{{ route('website.pages.add') }}" class="btn btn-success">
                                <i class="fas fa-plus mr-1"></i>Add Page
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-xl-4">
                    <div class="card card-info h-100">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-code mr-2"></i>Code Blocks</h3>
                        </div>
                        <div class="card-body">
                            <p>Create and manage reusable code snippets.</p>
                            <a href="{{ route('website.code-snippets') }}" class="btn btn-primary">
                                <i class="fas fa-list mr-1"></i>Manage Code Blocks
                            </a>
                            <a href="{{ route('website.code-snippets.add') }}" class="btn btn-success">
                                <i class="fas fa-plus mr-1"></i>Add Code Block
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-xl-4">
                    <div class="card card-info h-100">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-database mr-2"></i>Entities &amp; Records</h3>
                        </div>
                        <div class="card-body">
                            <p>Manage data entities, their fields, and records.</p>
                            <a href="{{ route('website.entities') }}" class="btn btn-primary">
                                <i class="fas fa-list mr-1"></i>Manage Entities
                            </a>
                            <a href="{{ route('website.entities.add') }}" class="btn btn-success">
                                <i class="fas fa-plus mr-1"></i>Add Entity
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-xl-4">
                    <div class="card card-info h-100">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-edit mr-2"></i>Template Editor</h3>
                        </div>
                        <div class="card-body">
                            <p>Open the editor for your website templates.</p>
                            <a href="{{ route('website.template-editor') }}" class="btn btn-primary">
                                <i class="fas fa-edit mr-1"></i>Open Template Editor
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-xl-4">
                    <div class="card card-info h-100">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-cog mr-2"></i>Website Settings</h3>
                        </div>
                        <div class="card-body">
                            <p>View and update your website configuration.</p>
                            <a href="{{ route('website.settings') }}" class="btn btn-primary">
                                <i class="fas fa-cog mr-1"></i>Manage Settings
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-xl-4">
                    <div class="card card-info h-100">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-external-link-alt mr-2"></i>Website Tools</h3>
                        </div>
                        <div class="card-body">
                            <p>Preview your site or browse its uploaded files.</p>
                            <a href="{{ route('website.preview', ['websiteId' => session('website_id'), 'slug' => 'home']) }}"
                               class="btn btn-primary"
                               target="_blank"
                               rel="noopener">
                                <i class="fas fa-eye mr-1"></i>Preview Site
                            </a>
                            <a href="{{ url('/laravel-filemanager?type=Files') }}"
                               class="btn btn-secondary"
                               target="_blank"
                               rel="noopener">
                                <i class="fas fa-folder mr-1"></i>File Manager
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection
