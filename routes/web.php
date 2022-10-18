<?php

use App\Models\User;
use App\Events\SendNotificationEvent;
use App\Notifications\GodTaskNotification;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Notification;
use App\Notifications\TaskCompletedNotification;

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

Auth::routes();

Route::get('/', function () {
    return view('welcome');
});

Route::get('event', function() {
    event(new SendNotificationEvent("I event to you my lovely listener"));
    dd("Sent Event notify");
});

Route::get('listen', function() {
    return view('listen');
});


// Testing Notification project start
Route::get('notify', function() {
    $user = User::find(1);
    // $user->notify(new TaskCompletedNotification); //using notifiable trait

    Notification::send($user, new TaskCompletedNotification); // using notification facade
    dd("Notify");
});

Route::get('mark-as-read', function() {
    $notis = auth()->user()->unreadNotifications();
    auth()->user()->unreadNotifications->markAsRead();
    return redirect()->back();
})->name('mark-as-read');
Route::get('godify', function() {
    $user = User::find(1);
    $delay = now()->addSeconds(2);
    $user->notify((new GodTaskNotification())->delay(2));

    // Notification::send($user, new GodTaskNotification);
    dd("God task completed!");
});

//Testing Notification porject end

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
