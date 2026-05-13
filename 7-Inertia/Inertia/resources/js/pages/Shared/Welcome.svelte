<script module lang="ts">
    import { dashboard } from '@/routes';

    export const layout = {
        breadcrumbs: [
            {
                title: 'Dashboard',
                href: dashboard(),
            },
        ],
    };
</script>

<script lang="ts">
    import { Deferred, Link } from '@inertiajs/svelte';
    import { CloudRain, CloudSun, MapPin, Sun, Sunrise } from 'lucide-svelte';
    import AppHead from '@/components/AppHead.svelte';
    import { Button } from '@/components/ui/button';

    type ForecastDay = {
        name: string;
        temp: string;
        icon: typeof Sun;
    };

    type DashboardStats = {
        users: number;
        latestUsers: {
            name: string;
            email: string;
        }[];
    };

    const { stats } = $props<{ stats?: DashboardStats }>();

    const forecast: ForecastDay[] = [
        { name: 'Monday', temp: '23°', icon: Sun },
        { name: 'Tuesday', temp: '9°', icon: CloudRain },
        { name: 'Wednesday', temp: '12°', icon: CloudSun },
        { name: 'Thursday', temp: '13°', icon: CloudSun },
        { name: 'Friday', temp: '16°', icon: CloudSun },
    ];
</script>

<AppHead title="Dashboard" />

<div
    class="min-h-[calc(100vh-5rem)] overflow-hidden rounded-xl bg-slate-950 bg-cover bg-center p-4 text-white shadow-2xl md:p-8"
    style="background-image: linear-gradient(rgba(15, 23, 42, 0.28), rgba(15, 23, 42, 0.52)), url('https://images.unsplash.com/photo-1506744626753-1fa00d52e9c5?q=80&w=2070&auto=format&fit=crop')"
>
    <div class="mx-auto flex w-full max-w-5xl justify-end">
        <Button asChild variant="secondary">
            {#snippet children(props)}
                <Link href="/users" prefetch {...props}>View users</Link>
            {/snippet}
        </Button>
    </div>

    <div class="mx-auto mt-10 grid w-full max-w-5xl gap-6 lg:grid-cols-[minmax(0,1fr)_280px]">
        <div
            class="rounded border border-white/30 bg-white/15 px-6 py-10 shadow-[0_25px_45px_rgba(0,0,0,0.25)] backdrop-blur-xl md:px-10"
        >
            <div class="mb-12 flex items-center justify-center gap-8">
                <Sunrise class="size-20 stroke-[1.2] md:size-24" />

                <div>
                    <h1 class="text-5xl font-light tracking-wide md:text-6xl">17° C</h1>
                    <p class="mt-2 flex items-center gap-2 text-sm opacity-90">
                        <MapPin class="size-4" />
                        Hannover
                    </p>
                </div>
            </div>

            <div class="grid grid-cols-5 gap-3">
                {#each forecast as day}
                    {@const Icon = day.icon}
                    <div class="flex min-w-0 flex-col items-center text-center">
                        <Icon class="mb-4 size-7 md:size-8" />
                        <div class="mb-2 text-base font-medium md:text-lg">{day.temp}</div>
                        <div class="mb-3 h-px w-5 bg-white/70"></div>
                        <div class="max-w-full truncate text-xs font-light opacity-85 md:text-sm">
                            {day.name}
                        </div>
                    </div>
                {/each}
            </div>

            <div class="mt-10 flex justify-center gap-2">
                <span class="size-1.5 rounded-full bg-white/40"></span>
                <span class="size-1.5 rounded-full bg-white"></span>
                <span class="size-1.5 rounded-full bg-white/40"></span>
            </div>
        </div>

        <Deferred data="stats">
            {#snippet fallback()}
                <div
                    class="rounded border border-white/30 bg-white/15 p-6 shadow-[0_25px_45px_rgba(0,0,0,0.22)] backdrop-blur-xl"
                >
                    <div class="h-4 w-24 animate-pulse rounded bg-white/35"></div>
                    <div class="mt-6 h-9 w-16 animate-pulse rounded bg-white/35"></div>
                    <div class="mt-5 h-3 w-36 animate-pulse rounded bg-white/25"></div>
                </div>
            {/snippet}

            {#snippet children()}
                {#if stats}
                    <div
                        class="rounded border border-white/30 bg-white/15 p-6 shadow-[0_25px_45px_rgba(0,0,0,0.22)] backdrop-blur-xl"
                    >
                        <p class="text-sm font-medium text-white/75">Total users</p>
                        <p class="mt-4 text-4xl font-semibold text-white">{stats.users}</p>
                        <p class="mt-3 text-sm text-white/75">
                            {stats.latestUsers.length} recent signups loaded lazily
                        </p>
                    </div>
                {/if}
            {/snippet}
        </Deferred>
    </div>
</div>
