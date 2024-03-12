<aside id="right-sidebar" style="background: rgba(1, 1, 20, 0.5)"
    class="w-46 bg-gray-600 text-white p-6 overflow-auto shadow-md fixed inset-y-0 -right-full z-10 transform md:translate-x-0 transition-all">
    <nav class="space-y-10 mt-20">
        <a class="flex flex-col items-center space-y-2 text-white hover:text-gray-300" href="{{ url('/') }}">
            <svg class="h-10 w-10 text-gray-100" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span>
                {{ Auth::user()->name }}
            </span>
        </a>
        <a class="flex items-center space-x-2 text-white hover:text-gray-300" href="{{ url('logout') }}">
            <svg class="h-10 w-10 text-gray-100" width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" />
                <path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2" />
                <path d="M7 12h14l-3 -3m0 6l3 -3" />
            </svg>
            <span>
                Sign out
            </span>
        </a>
    </nav>
</aside>
