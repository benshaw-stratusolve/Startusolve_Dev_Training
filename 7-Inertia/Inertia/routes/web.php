<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return redirect()->route('login');
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Shared/Welcome', [
            'stats' => Inertia::defer(fn () => [
                'users' => User::count(),
                'latestUsers' => User::latest()
                    ->take(5)
                    ->get(['name', 'email']),
            ]),
        ]);
    })->name('dashboard');

    Route::get('/users', function () {
        $search = request('search');

        return Inertia::render('Shared/Users', [
            'search' => $search,
            'users'  => User::when($search, fn ($q) => $q->where('name', 'like', "%{$search}%"))
                ->paginate(10)
                ->through(fn ($user) => [
                    'name'  => $user->name,
                    'email' => $user->email,
                    'avatar' => $user->avatar,
                ]),
        ]);
    })->name('users.index');

    Route::get('/users/create', function () {
        return Inertia::render('Users/Create');
    });

    Route::post('/users', function () {
        request()->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:8',
        ]);

        User::create([
            'name'     => request('name'),
            'email'    => request('email'),
            'password' => request('password'),
        ]);

        return redirect('/users');
    });
});

Route::get('/settings', function () {
    return Inertia::render('Shared/Settings');
});

Route::post('/settings/avatar', function () {
    request()->validate(['avatar' => 'required|url']);
    request()->user()->update(['avatar' => request('avatar')]);
    return back();
})->middleware('auth');
