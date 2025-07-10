<?php

use Illuminate\Support\Facades\Route;
use App\Models\GraduateThesis;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/theses', function () {
    $theses = (new GraduateThesis())->read();
    return view('theses', ['theses' => $theses]);
});
