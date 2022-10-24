<?php

declare(strict_types=1);

use App\Orchid\Screens\Examples\ExampleCardsScreen;
use App\Orchid\Screens\Examples\ExampleChartsScreen;
use App\Orchid\Screens\Examples\ExampleFieldsAdvancedScreen;
use App\Orchid\Screens\Examples\ExampleFieldsScreen;
use App\Orchid\Screens\Examples\ExampleLayoutsScreen;
use App\Orchid\Screens\Examples\ExampleScreen;
use App\Orchid\Screens\Examples\ExampleTextEditorsScreen;
use App\Orchid\Screens\PlatformScreen;
use App\Orchid\Screens\Role\RoleEditScreen;
use App\Orchid\Screens\Role\RoleListScreen;
use App\Orchid\Screens\User\UserEditScreen;
use App\Orchid\Screens\User\UserListScreen;
use App\Orchid\Screens\User\UserProfileScreen;
use Illuminate\Support\Facades\Route;
use Tabuna\Breadcrumbs\Trail;
use App\Orchid\Screens\trainRoutes;
use App\Orchid\Screens\trainRoutesAdd;
use App\Orchid\Screens\trainRoutesEdit;
use App\Orchid\Screens\timeTable;
use App\Orchid\Screens\timeTableAdd;
use App\Orchid\Screens\timeTableEdit;
use App\Orchid\Screens\seatAvailability;
use App\Orchid\Screens\seatavailabilityedit;
use App\Orchid\Screens\pricesTable;
use App\Orchid\Screens\pricesTableAdd;
use App\Orchid\Screens\pricesTableEdit;
use App\Orchid\Screens\trainDetails;
use App\Orchid\Screens\trainDetailsEdit;
use App\Orchid\Screens\trainDetailsAdd;
/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the need "dashboard" middleware group. Now create something great!
|
*/

// Main
Route::screen('/main', PlatformScreen::class)
    ->name('platform.main');

// Platform > Profile
Route::screen('profile', UserProfileScreen::class)
    ->name('platform.profile')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push(__('Profile'), route('platform.profile'));
    });

// Platform > System > Users
Route::screen('users/{user}/edit', UserEditScreen::class)
    ->name('platform.systems.users.edit')
    ->breadcrumbs(function (Trail $trail, $user) {
        return $trail
            ->parent('platform.systems.users')
            ->push(__('User'), route('platform.systems.users.edit', $user));
    });

// Platform > System > Users > Create
Route::screen('users/create', UserEditScreen::class)
    ->name('platform.systems.users.create')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.systems.users')
            ->push(__('Create'), route('platform.systems.users.create'));
    });

// Platform > System > Users > User
Route::screen('users', UserListScreen::class)
    ->name('platform.systems.users')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push(__('Users'), route('platform.systems.users'));
    });

// Platform > System > Roles > Role
Route::screen('roles/{role}/edit', RoleEditScreen::class)
    ->name('platform.systems.roles.edit')
    ->breadcrumbs(function (Trail $trail, $role) {
        return $trail
            ->parent('platform.systems.roles')
            ->push(__('Role'), route('platform.systems.roles.edit', $role));
    });

// Platform > System > Roles > Create
Route::screen('roles/create', RoleEditScreen::class)
    ->name('platform.systems.roles.create')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.systems.roles')
            ->push(__('Create'), route('platform.systems.roles.create'));
    });

// Platform > System > Roles
Route::screen('roles', RoleListScreen::class)
    ->name('platform.systems.roles')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push(__('Roles'), route('platform.systems.roles'));
    });

// Example...
Route::screen('example', ExampleScreen::class)
    ->name('platform.example')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push('Example screen');
    });

Route::screen('example-fields', ExampleFieldsScreen::class)->name('platform.example.fields');
Route::screen('example-layouts', ExampleLayoutsScreen::class)->name('platform.example.layouts');
Route::screen('example-charts', ExampleChartsScreen::class)->name('platform.example.charts');
Route::screen('example-editors', ExampleTextEditorsScreen::class)->name('platform.example.editors');
Route::screen('example-cards', ExampleCardsScreen::class)->name('platform.example.cards');
Route::screen('example-advanced', ExampleFieldsAdvancedScreen::class)->name('platform.example.advanced');
Route::screen('/trainroutes', trainRoutes::class)->name('platform.trainroutes');
Route::screen('trainrouteedit/{target?}', trainRoutesEdit::class)->name('platform.trainrouteedit');
Route::screen('trainrouteadd', trainRoutesAdd::class)->name('platform.trainrouteadd');
Route::screen('timetable', timeTable::class)->name('platform.timetable');
Route::screen('timetableadd', timeTableAdd::class)->name('platform.timetableadd');
Route::screen('timetableedit/{target?}', timeTableEdit::class)->name('platform.timetableedit');
Route::screen('seatavailability', seatAvailability::class)->name('platform.seatavailability');
Route::screen('seatavailabilityedit/{target?}', seatAvailabilityEdit::class)->name('platform.seatavailabilityedit');
Route::screen('pricestable', pricesTable::class)->name('platform.pricestable');
Route::screen('pricestableadd', pricesTableAdd::class)->name('platform.pricestableadd');
Route::screen('pricestableedit/{target?}', pricesTableEdit::class)->name('platform.pricestableedit');
Route::screen('traindetails', trainDetails::class)->name('platform.traindetails');
Route::screen('traindetailsadd', trainDetailsAdd::class)->name('platform.traindetailsadd');
Route::screen('traindetailsedit/{target?}', trainDetailsEdit::class)->name('platform.traindetailsedit');