<header class="flex items-center justify-between px-6 py-4 bg-gray-900 text-white">
    <div class="flex items-center space-x-2"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
            stroke-linejoin="round" class="h-6 w-6">
            <path d="m8 3 4 8 5-5 5 15H2L8 3z"></path>
        </svg><span class="text-lg font-semibold">Linkshort admin</span></div>
    <div class="flex-1 mx-6">
        <div class="relative"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round"
                class="absolute left-3 top-1/2 transform -translate-y-1/2 h-5 w-5 text-gray-500">
                <circle cx="11" cy="11" r="8"></circle>
                <path d="m21 21-4.3-4.3"></path>
            </svg><input
                class="flex h-10 border border-input px-3 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 w-full pl-10 pr-4 py-2 rounded-md text-gray-900 placeholder-gray-500 bg-white"
                placeholder="Search..." type="search"></div>
    </div>
    @auth
        <span class="relative flex shrink-0 overflow-hidden rounded-full h-8 w-8" type="button"
            id="radix-:r1p:" aria-haspopup="menu" aria-expanded="false" data-state="closed"><span
                class="flex h-full w-full items-center justify-center rounded-full bg-muted">Admin</span>
        </span>
    @endauth
</header>
