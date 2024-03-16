@auth
    @if ( request()->is('/') )
        <script>
            window.location.href = "{{ url('/stats') }}";
        </script>
    @endif
@endauth
<header class="flex items-center shadow-xl justify-between px-6 py-4 z-20 text-white fixed w-full top-0" style="background: rgba(1, 1, 20, 0.5)">
    <button id="toggleSidebar" class="block lg:hidden w-40 text-white">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M3 4a1 1 0 0 1 1-1h12a1 1 0 1 1 0 2H4a1 1 0 0 1-1-1zm0 5a1 1 0 0 1 1-1h12a1 1 0 1 1 0 2H4a1 1 0 0 1-1-1zm0 5a1 1 0 0 1 1-1h12a1 1 0 1 1 0 2H4a1 1 0 0 1-1-1z" clip-rule="evenodd" />
        </svg>
    </button>
    <div class="flex items-center w-1/2 sm:w-1/3 md:w-1/4 space-x-2">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6">
            <path d="m8 3 4 8 5-5 5 15H2L8 3z"></path>
        </svg>
        <span class="text-lg font-semibold">Linkshort admin</span>
    </div>
    @auth
        <div class="flex flex-row justify-center sm:w-1/2 md:w-2/4">
    @else
        <div class="flex flex-row justify-start sm:w-2/3 md:w-3/4">
    @endauth
        <div class="relative w-3/4 md:w-2/4">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="absolute left-3 top-1/2 transform -translate-y-1/2 h-5 w-5 text-gray-500">
                <circle cx="11" cy="11" r="8"></circle>
                <path d="m21 21-4.3-4.3"></path>
            </svg>
            <input class="flex h-10 border border-input px-3 text-sm ring-offset-background outline-none file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 w-full pl-10 pr-4 py-2 rounded-md text-gray-900 placeholder-gray-500 bg-white" placeholder="Search..." type="search">
        </div>
    </div>
    <div id="theme"></div>
    @auth
        <div class="relative flex justify-center w-1/4 sm:w-1/2 md:w-1/4">
            <span id="toggleButtonUser" class="cursor-pointer hover:text-gray-100 hover:underline transition-all flex h-full items-center justify-center rounded-full bg-muted font-bold">
                {{ Auth::user()->name }}
            </span>
        </div>
    @endauth
</header>
