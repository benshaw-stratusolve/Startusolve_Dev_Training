<x-layout title="Register">
    <div class="py-16">
        <div class="card bg-base-100 border border-base-300 shadow-sm w-full max-w-md mx-auto">
            <div class="card-body">
                <h2 class="card-title text-2xl font-bold mb-2 justify-center">Create an account</h2>
                <p class="text-sm opacity-60 mb-4 text-center">Already have an account? <a href="/login" class="link link-primary">Log in</a></p>

                <form method="POST" action="/register">
                    @csrf

                    <div class="flex flex-col gap-4">
                        <div>
                            <label for="name" class="label text-sm font-medium">Name</label>
                            <input
                                id="name"
                                name="name"
                                type="text"
                                value="{{ old('name') }}"
                                autocomplete="name"
                                class="input input-bordered w-full @error('name') input-error @enderror"
                                placeholder="Your Name" required />
                            
                            @error('name')
                                <p class="text-xs text-error mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="email" class="label text-sm font-medium">Email</label>
                            <input
                                id="email"
                                name="email"
                                type="email"
                                value="{{ old('email') }}"
                                autocomplete="email"
                                class="input input-bordered w-full @error('email') input-error @enderror"
                                placeholder="you@example.com" required />
                        
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
                                autocomplete="new-password"
                                class="input input-bordered w-full @error('password') input-error @enderror"
                                placeholder="••••••••" required/>
                            
                            @error('password')
                                <p class="text-xs text-error mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="password_confirmation" class="label text-sm font-medium">Confirm Password</label>
                            <input
                                id="password_confirmation"
                                name="password_confirmation"
                                type="password"
                                autocomplete="new-password"
                                class="input input-bordered w-full"
                                placeholder="••••••••" required/>
                            
                        </div>

                        <button type="submit" class="btn btn-primary w-full mt-2">
                            Create Account
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layout>
