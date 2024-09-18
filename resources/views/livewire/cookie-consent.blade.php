<div>
    @if($isVisible)
    <div class="fixed bottom-0 end-0 z-[60] sm:max-w-sm w-full mx-auto p-6">
        <div class="p-4 bg-white/60 backdrop-blur-lg rounded-xl shadow-2xl dark:bg-neutral-900/60 dark:shadow-black/70">
            <div class="flex justify-between gap-x-5">
                <div class="grow">
                    <h2 class="font-semibold text-gray-800 dark:text-white">
                        Cookie Settings
                    </h2>
                </div>
                <button type="button" class="inline-flex rounded-full p-2 text-gray-500 hover:bg-white focus:outline-none focus:bg-white dark:text-neutral-300 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800" wire:click="dismiss">
                    <span class="sr-only">Dismiss</span>
                    <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"></path><path d="m6 6 12 12"></path></svg>
                </button>
            </div>
            <p class="mt-2 text-sm text-gray-800 dark:text-neutral-200">
                We use cookies to improve your experience and for marketing. Visit our <a class="inline-flex items-center gap-x-1.5 text-blue-600 decoration-2 hover:underline focus:outline-none focus:underline font-medium dark:text-blue-500" href="{{ route('cookies.policy') }}">Cookies Policy</a> to learn more.
            </p>
            <div class="mt-5 mb-2 w-full flex gap-x-2">
                <button type="button" class="w-full py-2 px-3 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none" wire:click="allowAll">
                    Allow all
                </button>
                <button type="button" class="w-full py-2 px-3 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none" wire:click="rejectAll">
                    Reject all
                </button>
            </div>
            <div class="grid w-full">
                <button type="button" class="w-full py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-800 dark:focus:bg-neutral-800" wire:click="manageCookies">
                    Manage cookies
                </button>
            </div>
        </div>
    </div>
    @endif
</div>