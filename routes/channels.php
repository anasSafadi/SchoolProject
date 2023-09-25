<?php

use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

//Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
//    return (int) $user->id === (int) $id;
//});
////
//Broadcast::channel('App.Models.Teacher.{id}', function ($teacher, $id) {
//    return (int) $teacher->id === (int) $id;
//});


Broadcast::channel('lecture.{id_section}', function () {
    return true;
    }, ['guards' =>['teacher',"web","student"]]);


//    Broadcast::channel('lecture.{id_studentparent}', function () {
//        return true;
//        }, ['guards' =>['studentparent']]);

Broadcast::channel('teacher.{id_teacher}', function () {
    return true;
}, ['guards' =>['teacher']]);
