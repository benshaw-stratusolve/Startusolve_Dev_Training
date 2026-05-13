<script lang="ts">
    import { Link, page } from '@inertiajs/svelte';
</script>

<nav
    class="flex items-center justify-between border-b border-gray-200 dark:border-gray-700 bg-gray-200 dark:bg-gray-800 px-6 py-4"
>
    <div class="flex items-center gap-6">
        <span class="text-2xl font-bold text-black dark:text-white">My App</span>
        <ul class="flex list-inside items-center gap-4">
            <li>
                <Link
                    href="/"
                    class="text-blue-600 {page.url === '/'
                        ? 'font-bold'
                        : ''}">Home</Link
                >
            </li>
            <li>
                <Link
                    href="/users"
                    class="text-blue-600 {page.url === '/users'
                        ? 'font-bold'
                        : ''}">Users</Link
                >
            </li>
            <li>
                <Link
                    href="/settings"
                    class="text-blue-600 {page.url === '/settings'
                        ? 'font-bold'
                        : ''}">Choose Avatar</Link
                >
            </li>
        </ul>
    </div>

    {#if page.props.auth?.user}
        <div class="flex items-center gap-3">
            {#if page.props.auth.user.avatar}
                <img
                    src={page.props.auth.user.avatar}
                    alt="avatar"
                    class="h-9 w-9 rounded-full object-cover "
                />
            {/if}
            <Link
                href="/logout"
                method="post"
                as="button"
                class="rounded bg-red-500 px-4 py-1.5 text-sm text-white hover:bg-red-600"
            >
                Log out
            </Link>
        </div>
    {/if}
</nav>
