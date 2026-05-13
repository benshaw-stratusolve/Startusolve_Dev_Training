<script module lang="ts">
    export const layout = {
        title: 'Log in to your account',
        description: 'Enter your email and password below to log in',
    };
</script>

<script lang="ts">
    import { Form } from '@inertiajs/svelte';
    import AppHead from '@/components/AppHead.svelte';
    import InputError from '@/components/InputError.svelte';
    import PasswordInput from '@/components/PasswordInput.svelte';
    import TextLink from '@/components/TextLink.svelte';
    import { Button } from '@/components/ui/button';
    import { Checkbox } from '@/components/ui/checkbox';
    import { Input } from '@/components/ui/input';
    import { Label } from '@/components/ui/label';
    import { Spinner } from '@/components/ui/spinner';
    import { register } from '@/routes';
    import { store } from '@/routes/login';
    import { request } from '@/routes/password';

    let {
        status = '',
        canResetPassword,
        canRegister,
    }: {
        status?: string;
        canResetPassword: boolean;
        canRegister: boolean;
    } = $props();

</script>

<AppHead title="Log in" />

{#if status}
    <div class="mb-4 text-center text-sm font-medium text-green-300">
        {status}
    </div>
{/if}

<Form
    {...store.form()}
    resetOnSuccess={['password']}
    class="flex flex-col gap-5"
>
    {#snippet children({ errors, processing })}
        <div class="grid gap-5">
            <div class="grid gap-1.5">
                <label for="email" class="text-sm font-medium text-gray-700">Email address</label>
                <input
                    id="email"
                    type="email"
                    name="email"
                    required
                    autocomplete="email"
                    placeholder="email@example.com"
                    class="w-full rounded-lg border border-gray-300 bg-white/70 px-4 py-2.5 text-gray-900 placeholder-gray-400 backdrop-blur-sm focus:outline-none focus:ring-2 focus:ring-indigo-500"
                />
                <InputError message={errors.email} />
            </div>

            <div class="grid gap-1.5">
                <div class="flex items-center justify-between">
                    <label for="password" class="text-sm font-medium text-gray-700">Password</label>
                    {#if canResetPassword}
                        <TextLink href={request()} class="text-sm text-indigo-600 hover:text-indigo-700">
                            Forgot password?
                        </TextLink>
                    {/if}
                </div>
                <input
                    id="password"
                    type="password"
                    name="password"
                    required
                    autocomplete="current-password"
                    placeholder="Password"
                    class="w-full rounded-lg border border-gray-300 bg-white/70 px-4 py-2.5 text-gray-900 placeholder-gray-400 backdrop-blur-sm focus:outline-none focus:ring-2 focus:ring-indigo-500"
                />
                <InputError message={errors.password} />
            </div>

            <div class="flex items-center gap-2">
                <Checkbox id="remember" name="remember" />
                <label for="remember" class="text-sm text-gray-700">Remember me</label>
            </div>

            <button
                type="submit"
                disabled={processing}
                class="mt-1 w-full rounded-lg bg-indigo-600 px-4 py-2.5 font-semibold text-white hover:bg-indigo-700 disabled:opacity-50"
            >
                {#if processing}<Spinner />{/if}
                Log in
            </button>
        </div>

        {#if canRegister}
            <div class="text-center text-sm text-gray-600">
                Don't have an account?
                <TextLink href={register()} class="font-medium text-indigo-600 hover:underline">Sign up</TextLink>
            </div>
        {/if}
    {/snippet}
</Form>
