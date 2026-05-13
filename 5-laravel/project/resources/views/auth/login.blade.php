<x-layout title="Login">
    <div class="py-16">
        <div class="card bg-base-100 border border-base-300 shadow-sm w-full max-w-md mx-auto">
            <div class="card-body">
                <h2 class="card-title text-2xl font-bold mb-2 justify-center">Welcome back</h2>
                <p class="text-sm opacity-60 mb-4 text-center">Don't have an account? <a href="/register" class="link link-primary">Register</a></p>

                <form method="POST" action="/login">
                    @csrf

                    <div class="flex flex-col gap-4">
                        <div>
                            <label for="email" class="label text-sm font-medium">Email</label>
                            <input
                                id="email"
                                name="email"
                                type="email"
                                value="{{ old('email') }}"
                                autocomplete="email"   
                                class="input input-bordered w-full @error('email') input-error @enderror"
                                placeholder="you@example.com"
                                required />

                            @error('email')
                                <p class="text-xs text-error mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="password" class="label text-sm font-medium">Password</label>
                            <input
                                id="password"
                                name="password"
                                type="password"
                                autocomplete="current-password"
                                class="input input-bordered w-full @error('password') input-error @enderror"
                                placeholder="••••••••"
                                required />

                            @error('password')
                                <p class="text-xs text-error mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center gap-2">
                            <input type="checkbox" id="remember" name="remember" class="checkbox checkbox-sm" />
                            <label for="remember" class="text-sm">Remember me</label>
                        </div>

                        <button type="submit" class="btn btn-primary w-full mt-2">
                            Log In
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layout>
