<script lang="ts">
    import { page, router, Link, usePoll } from '@inertiajs/svelte';
    import { Search } from 'lucide-svelte';
    import debounce from 'lodash/debounce';
    import {
        Avatar,
        AvatarFallback,
        AvatarImage,
    } from '@/components/ui/avatar';
    import { getInitials } from '@/lib/initials';
    import Pagination from './Pagination.svelte';

    type User = { name: string; email: string; avatar?: string | null };
    type PaginationLink = { url: string | null; label: string; active: boolean };
    type Paginator = {
        data: User[];
        current_page: number;
        last_page: number;
        prev_page_url: string | null;
        next_page_url: string | null;
        links: PaginationLink[];
    };

    usePoll(2000, {
        only: ['users'],
    });

    const { users, search: initialSearch } = $props<{ users: Paginator; search: string }>();

    let search = $state(initialSearch ?? '');

    $effect(() => { search = initialSearch ?? ''; });

    const performSearch = debounce((value: string) => {
        router.get('/users', { search: value }, { preserveState: true, replace: true });
    }, 300);

    function onSearch(e: Event) {
        search = (e.target as HTMLInputElement).value;
        performSearch(search);
    }
</script>

<svelte:head>
    <title>Users - {page.props.name}</title>
</svelte:head>

<div class="mx-auto max-w-4xl px-8 py-10">
    <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Users</h1>

    <Link href="/users/create" class="text-blue-500">New User</Link>

    <div class="relative mt-4">
        <Search class="absolute top-2.5 left-2.5 h-4 w-4 text-gray-400 dark:text-white" />
        <input
            type="text"
            value={search}
            oninput={onSearch}
            placeholder="Search..."
            class="w-full rounded-lg border py-2 pr-4 pl-9 text-black dark:text-white focus:outline-none focus:ring-2 focus:ring-indigo-500"
        />
    </div>

    <ul class="mt-6 divide-y divide-gray-200 overflow-hidden rounded-lg border border-gray-200">
        {#each users.data as user, i (i)}
            <li class="flex items-center justify-between px-6 py-4">
                <div class="flex min-w-0 items-center gap-3">
                    <Avatar class="h-10 w-10">
                        {#if user.avatar}
                            <AvatarImage src={user.avatar} alt={user.name} class="object-cover" />
                        {/if}
                        <AvatarFallback>{getInitials(user.name)}</AvatarFallback>
                    </Avatar>

                    <div class="min-w-0">
                        <p class="truncate font-medium text-gray-900 dark:text-white">
                            {user.name}
                        </p>
                        <p class="truncate text-sm text-gray-500 dark:text-gray-400">
                            {user.email}
                        </p>
                    </div>
                </div>
                <a href="/users/{i}/edit" class="font-medium text-indigo-600 hover:text-indigo-500">View</a>
            </li>
        {/each}
    </ul>

    <Pagination links={users.links} />
</div>
