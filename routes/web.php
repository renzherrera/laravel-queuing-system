<?php

use App\Http\Controllers\Admin\CallController;
use App\Http\Controllers\Admin\ClientDisplayController;
use App\Http\Controllers\Admin\CounterController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\QueueCalled;
use App\Http\Controllers\Admin\QueueController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\SettingsUploadController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Livewire\Admin\Kiosk\KioskDepartment;
use App\Http\Livewire\Admin\Kiosk\KioskService;
use App\Http\Livewire\DepartmentsTable;
use App\Http\Livewire\QueuesTable;
use App\Http\Livewire\ServicesTable;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {

//     return view('welcome');

// });

// Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Auth::routes();
Route::post('settings-upload',[SettingsUploadController::class,'store']);

//kiosk routes
Route::get('kiosk-departments',KioskDepartment::class)->name('kiosk.departments');
Route::get('kiosk-departments/services/{department}',KioskService::class)->name('kiosk.departments.services');
Route::post('kiosk-departments/services/{service}/processing', [KioskService::class, 'storeQueue'])->name('kiosk.departments.services.store');


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group(['middleware'=> 'auth'], function(){
    Route::group(['prefix' => 'admin', 'as'=> 'admin.'],function(){
        Route::get('admin/departments/departments-pdf',[DepartmentsTable::class,'createPDF'])->name('departments.pdf');
        Route::get('admin/queues/queues-pdf',[QueuesTable::class,'queuesPDF'])->name('queues.pdf');
        Route::get('admin/services/services-pdf',[ServicesTable::class,'servicesPDF'])->name('services.pdf');
        // Route::get('displays/departments', [ClientDisplayController::class, 'showDepartments'])->name('displays.departments');
        // Route::get('admin.displays/services/{department}', [ClientDisplayController::class, 'showServices'])->name('displays.services');
        // Route::post('admin.displays/services/{service}/ticket-details/processing', [ClientDisplayController::class, 'storeQueue'])->name('displays.store');
        // Route::post('admin.displays/services/{service}/ticket-details', [ClientDisplayController::class, 'getTicketDetails'])->name('displays.ticket');
         Route::post('admin/settings/save-settings',[SettingsController::class,'update'])->name('settings.update');
         Route::get('admin/settings',[SettingsController::class,'index'])->name('settings.index');

        //  Route::resource('pages', PageController::class);
        // //  Route::resource('departments', DepartmentController::class);
        //  Route::resource('services', ServiceController::class);
        //  Route::resource('counters', CounterController::class);
        //  Route::resource('users', UserController::class);
        //  Route::resource('queues', QueueController::class);
         Route::resource('queues-called', QueueCalled::class);
         Route::resource('calls', CallController::class)->middleware('counter_assigned');
    
         

    });
});
