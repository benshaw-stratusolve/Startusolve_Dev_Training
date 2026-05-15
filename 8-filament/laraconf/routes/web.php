<?php

use App\Livewire\ConferenceSignupPage;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/app');

Route::get('/conference-signup', ConferenceSignupPage::class);