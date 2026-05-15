<div class="bg-white">
    {{-- Hero --}}
    <div class="relative isolate overflow-hidden bg-gradient-to-b from-indigo-100/20">
        <div class="mx-auto max-w-7xl pb-24 pt-10 sm:pb-32 lg:grid lg:grid-cols-2 lg:gap-x-8 lg:px-8 lg:py-40">
            <div class="px-6 lg:px-0 lg:pt-4">
                <div class="mx-auto max-w-2xl">
                    <div class="max-w-lg">
                        <div class="mt-24 sm:mt-32 lg:mt-16">
                            <span class="rounded-full bg-indigo-600/10 px-3 py-1 text-sm font-semibold leading-6 text-indigo-600 ring-1 ring-inset ring-indigo-600/10">
                                Coming Soon
                            </span>
                        </div>
                        <h1 class="mt-10 text-4xl font-bold tracking-tight text-gray-900 sm:text-6xl">
                            LaraConf 2026
                        </h1>
                        <p class="mt-6 text-lg leading-8 text-gray-600">
                            The premier Laravel conference for developers who want to level up their skills. Join us for two days of talks, workshops, and networking.
                        </p>
                        <div class="mt-10 flex items-center gap-x-6">
                            {{ $this->signUpAction }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Features --}}
    <div class="mx-auto mt-8 max-w-7xl px-6 lg:px-8">
        <div class="mx-auto max-w-2xl lg:text-center">
            <h2 class="text-base font-semibold leading-7 text-indigo-600">Conference highlights</h2>
            <p class="mt-2 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">
                Everything you need to grow as a developer
            </p>
        </div>
        <div class="mx-auto mt-16 max-w-2xl sm:mt-20 lg:mt-24 lg:max-w-4xl">
            <dl class="grid max-w-xl grid-cols-1 gap-x-8 gap-y-10 lg:max-w-none lg:grid-cols-2 lg:gap-y-16">
                <div class="relative pl-16">
                    <dt class="text-base font-semibold leading-7 text-gray-900">
                        <div class="absolute left-0 top-0 flex h-10 w-10 items-center justify-center rounded-lg bg-indigo-600">
                            <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 18v-5.25m0 0a6.01 6.01 0 001.5-.189m-1.5.189a6.01 6.01 0 01-1.5-.189m3.75 7.478a12.06 12.06 0 01-4.5 0m3.75 2.383a14.406 14.406 0 01-3 0M14.25 18v-.192c0-.983.658-1.823 1.508-2.316a7.5 7.5 0 10-7.517 0c.85.493 1.509 1.333 1.509 2.316V18" /></svg>
                        </div>
                        World-class speakers
                    </dt>
                    <dd class="mt-2 text-base leading-7 text-gray-600">Learn from the best minds in the Laravel ecosystem, including core contributors and industry leaders.</dd>
                </div>
                <div class="relative pl-16">
                    <dt class="text-base font-semibold leading-7 text-gray-900">
                        <div class="absolute left-0 top-0 flex h-10 w-10 items-center justify-center rounded-lg bg-indigo-600">
                            <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" /></svg>
                        </div>
                        Hands-on workshops
                    </dt>
                    <dd class="mt-2 text-base leading-7 text-gray-600">Deep-dive into practical workshops covering Filament, Livewire, testing, and more.</dd>
                </div>
            </dl>
        </div>
    </div>

    <footer class="mx-auto mt-16 max-w-7xl px-6 py-12 lg:px-8">
        <p class="text-center text-xs leading-5 text-gray-500">&copy; 2026 LaraConf. All rights reserved.</p>
    </footer>

    <x-filament-actions::modals />
    @livewire('notifications')
</div>
