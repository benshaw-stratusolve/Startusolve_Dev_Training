<script lang="ts">
    import { page, router } from '@inertiajs/svelte';

    const avatars = [
        'https://img.daisyui.com/images/profile/demo/batperson@192.webp',
        'https://img.daisyui.com/images/profile/demo/spiderperson@192.webp',
        'https://img.daisyui.com/images/profile/demo/averagebulk@192.webp',
        'https://img.daisyui.com/images/profile/demo/yellingwoman@192.webp',
        'https://img.daisyui.com/images/profile/demo/superperson@192.webp',
    ];

    const user = $derived(page.props.auth?.user as { name: string; avatar?: string } | null);
    let selected = $state('');
    $effect(() => { selected = user?.avatar ?? ''; });

    function pick(url: string) {
        selected = url;
        router.post('/settings/avatar', { avatar: url }, { preserveScroll: true });
    }
</script>

<svelte:head>
    <title>Settings - {page.props.name}</title>
</svelte:head>

<div class="mx-auto max-w-2xl px-8 py-10">
    <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Choose Avatar</h1>
    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Select an avatar to display next to your name.</p>

    <div class="mt-8 grid grid-cols-3 gap-4 sm:grid-cols-6">
        {#each avatars as url}
            <button
                onclick={() => pick(url)}
                class="group relative rounded-full focus:outline-none"
            >
                <img
                    src={url}
                    alt="avatar"
                    class="h-16 w-16 rounded-full object-cover ring-4 transition {selected === url
                        ? 'ring-indigo-500 scale-110'
                        : 'ring-transparent hover:ring-indigo-300'}"
                />
                {#if selected === url}
                    <span class="absolute -bottom-1 -right-1 flex h-5 w-5 items-center justify-center rounded-full bg-indigo-500 text-xs text-white">✓</span>
                {/if}
            </button>
        {/each}
    </div>

    {#if selected}
        <div class="mt-8 flex items-center gap-4 rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 px-6 py-4">
            <img src={selected} alt="current avatar" class="h-14 w-14 rounded-full object-cover" />
            <div>
                <p class="font-medium text-gray-900 dark:text-white">{user?.name}</p>
                <p class="text-sm text-gray-500 dark:text-gray-400">Current avatar</p>
            </div>
        </div>
    {/if}
</div>
