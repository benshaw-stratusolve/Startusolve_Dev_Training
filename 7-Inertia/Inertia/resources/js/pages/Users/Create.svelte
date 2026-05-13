<svelte:head>
    <title>Create User - {page.props.name}</title>
</svelte:head>

<div class="px-8 py-10">
    <h1 class="text-3xl font-bold text-gray-900">Create New User</h1>

    <form onsubmit={submit} class="mx-auto mt-8 max-w-lg space-y-6">
        <div>
            <label for="name" class="mb-2 block text-xs font-bold uppercase text-gray-700">Name</label>
            <input
                id="name"
                type="text"
                bind:value={form.name}
                class="text-black w-full rounded border border-gray-300 p-3 focus:outline-none focus:ring-2 focus:ring-indigo-500"
            />
            {#if form.errors.name}
                <p class="mt-1 text-sm text-red-600">{form.errors.name}</p>
            {/if}
        </div>

        <div>
            <label for="email" class="mb-2 block text-xs font-bold uppercase text-gray-700">Email</label>
            <input
                id="email"
                type="email"
                bind:value={form.email}
                class="text-black w-full rounded border border-gray-300 p-3 focus:outline-none focus:ring-2 focus:ring-indigo-500"
            />
            {#if form.errors.email}
                <p class="mt-1 text-sm text-red-600">{form.errors.email}</p>
            {/if}
        </div>

        <div>
            <label for="password" class="mb-2 block text-xs font-bold uppercase text-gray-700">Password</label>
            <input
                id="password"
                type="password"
                bind:value={form.password}
                class="text-black w-full rounded border border-gray-300 p-3 focus:outline-none focus:ring-2 focus:ring-indigo-500"
            />
            {#if form.errors.password}
                <p class="mt-1 text-sm text-red-600">{form.errors.password}</p>
            {/if}
        </div>

        <button
            type="submit"
            disabled={form.processing}
            class="rounded bg-indigo-400 px-6 py-3 text-white hover:bg-indigo-500 disabled:opacity-50"
        >
            {form.processing ? 'Submitting...' : 'Submit'}
        </button>
    </form>
</div>

<script lang="ts">
    import Inertia from '@/actions/Inertia';
    import { page, useForm } from '@inertiajs/svelte';

    const form = useForm({
        name: '',
        email: '',
        password: '',
    });

    function submit(e: Event) {
        e.preventDefault();
        form.post('/users');
    }

    // let submit = () => {
    //     Inertia.post();
    // };

</script>
