<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('landingpage');
});
Route::post ('/register', ([AuthController::class, 'register']))->name('register.submit');
Route::get('/login', function () {
    return view('login'); 
})->name('login');
Route::post('/login', function () {
    return redirect('/');
})->name('login.submit');

// Organizer Dashboard
Route::get('/organizer/dashboard', function () {
    return view('Organizersdashboard.Organizersdashboard');
})->name('organizer.dashboard');

Route::get('/organizer/events', 'App\Http\Controllers\EventController@index')->name('events.index');
Route::post('/organizer/events', 'App\Http\Controllers\EventController@store')->name('events.store');
Route::get('/organizer/events/{id}/edit', 'App\Http\Controllers\EventController@edit')->name('events.edit');
Route::put('/organizer/events/{id}', 'App\Http\Controllers\EventController@update')->name('events.update');
Route::delete('/organizer/events/{id}', 'App\Http\Controllers\EventController@destroy')->name('events.destroy');

// Participants List
Route::get('/organizer/participants', 'App\Http\Controllers\ParticipantController@index')->name('participants.index');

// Analytics
Route::get('/organizer/analytics', 'App\Http\Controllers\AnalyticsController@index')->name('analytics.index');

// Participants Dashboard
Route::get('/participants', function () {
    return view('Participantsdashboard.participantsdashboard');
})->name('participants.dashboard');

// Admin Dashboard
Route::get('/admin', function () {
    return view('admindashboard.admindashboard');
})->name('admin.dashboard');

// Organizers Dashboard (alias route for consistency)
Route::get('/organizers', function () {
    return view('Organizersdashboard.Organizersdashboard');
})->name('organizers.dashboard');

Route::post('/logout', function () {
    return redirect('/');
})->name('logout');
