<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\WebsiteController;
use App\Http\Controllers\Website\CodeSnippetController;
use App\Http\Controllers\Website\EntityController;
use App\Http\Controllers\Website\EntityFieldController;
use App\Http\Controllers\Website\EntityRecordController;
use App\Http\Controllers\Website\FileManagerController;
use App\Http\Controllers\Website\FileManagerUploadController;
use App\Http\Controllers\Website\FrontendController;
use App\Http\Controllers\Website\PageController;
use App\Http\Controllers\Website\TemplateFileController;
use App\Http\Controllers\Website\WebsiteAuthController;
use App\Http\Controllers\Website\WebsiteSettingController;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->group(function () {

    // Login Page
    Route::get('/', [AuthController::class, 'login'])
        ->name('admin.login');

    // Login Submit
    Route::post('/login-submit', [AuthController::class, 'loginSubmit'])
        ->name('admin.login.submit');

    /*
    |--------------------------------------------------------------------------
    | Protected Admin Routes
    |--------------------------------------------------------------------------
    */

    Route::middleware(['admin.auth', 'super.admin', 'nocache'])->group(function () {

        // Dashboard
        Route::get('/dashboard', [AuthController::class, 'dashboard'])
            ->name('admin.dashboard');

        // Logout
        Route::post('/logout', [AuthController::class, 'logout'])
            ->name('admin.logout');
    });

    /*
        |--------------------------------------------------------------------------
        | Website Routes
        |--------------------------------------------------------------------------
        */

    Route::middleware(['admin.auth', 'super.admin'])->group(function () {

        // Website Listing
        Route::get('/websites', [WebsiteController::class, 'index'])
            ->name('admin.websites');

        // Add Website Form
        Route::get('/websites/add', [WebsiteController::class, 'add'])
            ->name('admin.websites.add');

        // Store Website
        Route::post('/websites/store', [WebsiteController::class, 'store'])
            ->name('admin.websites.store');
        // Edit Website Form
        Route::get('/websites/edit/{id}', [WebsiteController::class, 'edit'])
            ->name('admin.websites.edit');

        // Update Website
        Route::put('/websites/update/{id}', [WebsiteController::class, 'update'])
            ->name('admin.websites.update');

        // Delete Website

        Route::delete('/websites/delete/{id}', [WebsiteController::class, 'destroy'])
            ->name('admin.websites.delete');


            /*
            |--------------------------------------------------------------------------
            | User Management Routes
            |--------------------------------------------------------------------------
            */

        Route::get('/users', [UserController::class, 'index'])
            ->name('admin.users');

        Route::get('/users/add', [UserController::class, 'add'])
            ->name('admin.users.add');

        Route::post('/users/store', [UserController::class, 'store'])
            ->name('admin.users.store');

        Route::get('/users/edit/{id}', [UserController::class, 'edit'])
            ->name('admin.users.edit');

        Route::put('/users/update/{id}', [UserController::class, 'update'])
            ->name('admin.users.update');

        Route::delete('/users/delete/{id}', [UserController::class, 'destroy'])
            ->name('admin.users.delete');

    });

});


/////////////////////////   WEBSITE LOGIN ROUTES (ADMIN/STAFF REQUIRED)  //////////////////////////////

Route::prefix('website')->middleware('admin.auth')->group(function () {

    Route::get('/login', [WebsiteAuthController::class, 'login'])
        ->name('website.login');

    Route::post('/login-submit', [WebsiteAuthController::class, 'loginSubmit'])
        ->name('website.login.submit');

});

/////////////////////////   WEBSITE ROUTES STARTS ////////////////////////////////////////////////


Route::prefix('website')->middleware('website.auth')->group(function () {

    Route::get('/dashboard', [WebsiteAuthController::class, 'dashboard'])
        ->name('website.dashboard');

    Route::post('/logout', [WebsiteAuthController::class, 'logout'])
        ->name('website.logout');


/////////////////////////   ENTITIES ROUTES  ////////////////////////////////////////////////

     Route::get('/entities', [EntityController::class, 'index'])
        ->name('website.entities');

    Route::get('/entities/add', [EntityController::class, 'add'])
        ->name('website.entities.add');

    Route::post('/entities/store', [EntityController::class, 'store'])
        ->name('website.entities.store');

    Route::get('/entities/edit/{id}', [EntityController::class, 'edit'])
        ->name('website.entities.edit');

    Route::put('/entities/update/{id}', [EntityController::class, 'update'])
        ->name('website.entities.update');

    Route::delete('/entities/delete/{id}', [EntityController::class, 'destroy'])
        ->name('website.entities.delete');

/////////////////////////   ENTITIES FIELDS Routes  ////////////////////////////////////////////////


    // Entity Fields Listing
Route::get('/entities/{entity}/fields', [EntityFieldController::class, 'index'])
    ->name('website.entity-fields');

// Add Field Form
Route::get('/entities/{entity}/fields/add', [EntityFieldController::class, 'add'])
    ->name('website.entity-fields.add');

// Store Field
Route::post('/entities/{entity}/fields/store', [EntityFieldController::class, 'store'])
    ->name('website.entity-fields.store');

// Edit Field
Route::get('/entities/{entity}/fields/edit/{field}', [EntityFieldController::class, 'edit'])
    ->name('website.entity-fields.edit');

// Update Field
Route::put('/entities/{entity}/fields/update/{field}', [EntityFieldController::class, 'update'])
    ->name('website.entity-fields.update');

// Delete Field
Route::delete('/entities/{entity}/fields/delete/{field}', [EntityFieldController::class, 'destroy'])
    ->name('website.entity-fields.delete');



/////////////////////////   ENTITIEY RECORDS  ////////////////////////////////////////////////

// Records Listing
Route::get('/entities/{entity}/records', [EntityRecordController::class, 'index'])
    ->name('website.entity-records');

// Add Record Form
Route::get('/entities/{entity}/records/add', [EntityRecordController::class, 'add'])
    ->name('website.entity-records.add');

    // Store Entity Record
Route::post('/entities/{entity}/records/store', [EntityRecordController::class, 'store'])
    ->name('website.entity-records.store');


    // Edit Record
Route::get('/entities/{entity}/records/edit/{record}', [EntityRecordController::class, 'edit'])
    ->name('website.entity-records.edit');

// Update Record
Route::put('/entities/{entity}/records/update/{record}', [EntityRecordController::class, 'update'])
    ->name('website.entity-records.update');

    // Delete Record
Route::delete('/entities/{entity}/records/delete/{record}', [EntityRecordController::class, 'destroy'])
    ->name('website.entity-records.delete');



/////////////////////////   Code Snippets Routes  ////////////////////////////////////////////////

// Listing
Route::get('/code-snippets', [CodeSnippetController::class, 'index'])
    ->name('website.code-snippets');

// Add Form
Route::get('/code-snippets/add', [CodeSnippetController::class, 'add'])
    ->name('website.code-snippets.add');

// Edit Form
Route::get('/code-snippets/edit/{id}', [CodeSnippetController::class, 'edit'])
    ->name('website.code-snippets.edit');

/////////////////////////   Pages  ////////////////////////////////////////////////


// List Pages
Route::get('/pages', [PageController::class, 'index'])
    ->name('website.pages');

// Add Page
Route::get('/pages/add', [PageController::class, 'add'])
    ->name('website.pages.add');

Route::get('/pages/template-styles', [PageController::class, 'templateStyles'])
    ->name('website.pages.template-styles');

// Store Page
Route::post('/pages/store', [PageController::class, 'store'])
    ->name('website.pages.store');

// Edit Page
Route::get('/pages/edit/{id}', [PageController::class, 'edit'])
    ->name('website.pages.edit');

// Duplicate Page
Route::post('/pages/duplicate/{id}', [PageController::class, 'duplicate'])
    ->name('website.pages.duplicate');

// Update Page
Route::put('/pages/update/{id}', [PageController::class, 'update'])
    ->name('website.pages.update');

// Delete Page
Route::delete('/pages/delete/{id}', [PageController::class, 'destroy'])
    ->name('website.pages.delete');

/////////////////////////   Setting Route  ////////////////////////////////////////////////

Route::get('/settings', [WebsiteSettingController::class, 'index'])
    ->name('website.settings');

Route::post('/settings/update', [WebsiteSettingController::class, 'update'])
    ->name('website.settings.update');

/////////////////////////   File Manager Route  ////////////////////////////////////////////////

// Route::get('/file-manager', [FileManagerController::class, 'index'])
//     ->name('website.file-manager');

// Route::get('/filemanager', function () {
//     return view('website.filemanager.index');
// })->name('website.filemanager');



/////////////////////////   Template editor ROUTES  ////////////////////////////////////////////////


    Route::get('/template-editor', [TemplateFileController::class, 'index'])
    ->name('website.template-editor');

Route::get('/template-editor/edit', [TemplateFileController::class, 'edit'])
    ->name('website.template-editor.edit');

    Route::post('/template-editor/save', [TemplateFileController::class, 'save'])
    ->name('website.template-editor.save');


/////////////////////////   Web preview routes  ////////////////////////////////////////////////

Route::get('/preview/{websiteId}/{slug?}', [FrontendController::class, 'preview'])
    ->where('slug', '.*')
    ->defaults('slug', 'home')
    ->name('website.preview');


});

Route::group([
    'prefix' => 'laravel-filemanager',
    'middleware' => ['web', 'website.filemanager'],
], function () {

    \UniSharp\LaravelFilemanager\Lfm::routes();

    Route::post('/upload', [FileManagerUploadController::class, 'upload'])
        ->middleware([
            \UniSharp\LaravelFilemanager\Middlewares\CreateDefaultFolder::class,
            \UniSharp\LaravelFilemanager\Middlewares\MultiUser::class,
        ])
        ->name('unisharp.lfm.upload');

});