@auth
    @if ( request()->is('/') )
        <script>
            window.location.href = "{{ url('/users') }}";
        </script>
    @endif
@endauth
<header class="flex items-center justify-between px-6 py-4 bg-gray-900 text-white fixed w-full top-0">
    <div class="flex items-center w-1/4 space-x-2"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
            stroke-linejoin="round" class="h-6 w-6">
            <path d="m8 3 4 8 5-5 5 15H2L8 3z"></path>
        </svg><span class="text-lg font-semibold">Linkshort admin</span>
    </div>
    @auth
        <div class="flex flex-row justify-center md:w-2/4">
    @else
        <div class="flex flex-row justify-start md:w-3/4">
    @endauth
        <div class="relative w-2/4"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
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
        <span class="relative flex w-1/4 rounded-full h-8 w-8">
                <span id="toggleButton" class="cursor-pointer flex h-full items-center justify-center rounded-full bg-muted font-bold">
                    Admin
                </span>
                <ul id="childElements" class="hidden absolute left-20 top-6 w-1/2 text-black bg-white shadow-lg rounded-full transition-all z-20">
                    <li class="style-none px-2 text-gray-700 hover:bg-gray-200 bg-white flex flex-row justify-center items-center z-20">
                        <a href="#">Settings</a>
                    </li>
                    <li class="style-none px-2 text-gray-700 hover:bg-gray-200 bg-white flex flex-row justify-center items-center z-20">
                        <a class="w-full m-auto flex flex-row justify-center" href="{{ url('logout') }}">Sign out</a>
                    </li>
                </ul>
        </span>
    @endauth
    <script>
        document.getElementById('toggleButton').addEventListener('click', function () {
            // Toggle visibility of child elements
            var childElements = document.getElementById('childElements');
            if (childElements.classList.contains('hidden')) {
                childElements.classList.remove('hidden');
            } else {
                childElements.classList.add('hidden');
            }
        });
    </script>
</header>
