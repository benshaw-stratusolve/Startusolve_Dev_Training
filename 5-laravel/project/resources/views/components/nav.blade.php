<div class="navbar bg-base-100 shadow-sm">
    <div class="navbar-start">
        <div class="dropdown">
            <div tabindex="0" role="button" class="btn btn-ghost lg:hidden">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h8m-8 6h16" />
                </svg>
            </div>
            <ul 
                tabindex="0" 
                class="menu menu-sm dropdown-content bg-base-100 rounded-box z-10 mt-3 w-52 p-2 shadow">
                <li><a href="/ideas">Home</a></li>
                <li><a href="/ideas/create">New Idea</a></li>
                @can('view-admin')
                    <li><a href="/admin">Admin</a></li>
                @endcan
            </ul>
        </div>
        <a class="btn btn-ghost text-xl" href="/ideas">Idea</a>
    </div>
    <div class="navbar-center hidden lg:flex">
        <ul class="menu menu-horizontal px-1">
            <li><a href="/ideas">Home</a></li>
            <li><a href="/ideas/create">New Idea</a></li>
            @can('view-admin')
                <li><a href="/admin">Admin</a></li>
            @endcan
        </ul>
    </div>
    <div class="navbar-end space-x-2">
        <button id="theme-toggle" onclick="toggleTheme()" class="btn btn-ghost btn-sm btn-circle">
            <svg id="icon-sun" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m8.66-9H21M3 12H2m15.36-6.36l-.7.7M7.34 16.95l-.7.71M18.36 17.66l-.7-.71M7.05 7.34l-.71-.7M12 7a5 5 0 100 10A5 5 0 0012 7z" />
            </svg>
            <svg id="icon-moon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
            </svg>
        </button>
        @guest
            <a class="btn btn-primary" href="/register">Register</a>
            <a class="btn btn-primary" href="/login">Log In</a>
        @endguest

        @auth
            <form method="POST" action="/logout">
                @csrf
                @method('DELETE')
                <button class="btn btn-ghost">Log Out</button>
            </form>
        @endauth
    </div>
</div>

<script>
    function toggleTheme() {
        const current = document.documentElement.getAttribute('data-theme');
        setTheme(current === 'dracula' ? 'light' : 'dracula');
    }

    function setTheme(theme) {
        document.documentElement.setAttribute('data-theme', theme);
        localStorage.setItem('theme', theme);
        document.getElementById('icon-sun').classList.toggle('hidden', theme !== 'dracula');
        document.getElementById('icon-moon').classList.toggle('hidden', theme !== 'light');
    }

    const current = document.documentElement.getAttribute('data-theme') || 'dracula';
    setTheme(current);
</script>
