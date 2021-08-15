
<?php

use App\Http\Livewire\Admin\Calls\Call;
use App\Http\Livewire\Admin\Calls\ListCall;
use App\Http\Livewire\Admin\Counters\ListCounters;
use App\Http\Livewire\Admin\Departments\ListDepartments;
use App\Http\Livewire\Admin\Kiosk\KioskDepartment;
use App\Http\Livewire\Admin\Kiosk\KioskService;
use App\Http\Livewire\Admin\Services\ListServices;
use App\Http\Livewire\Admin\Users\ListUsers;
use Illuminate\Support\Facades\Route;

// Route::get('dashboard',DashboardController::class)->name('dashboard');
// Route::get('appointments/create',CreateAppointmentForm::class)->name('appointments.create');
// Route::get('appointments/{appointment}/edit',UpdateAppointmentForm::class)->name('appointments.edit');
Route::get('departments',ListDepartments::class)->name('departments');

Route::get('counters',ListCounters::class)->name('counters');
Route::get('services',ListServices::class)->name('services');
Route::get('users',ListUsers::class)->name('users');
Route::get('calls',ListCall::class)->name('calls');
