@extends('dashboard')

@section('title', 'Stats')

@section('main-content')
    <div class="flex flex-col justify-center items-center ml-auto lg:ml-40 mt-20 w-full">
        @if ( $params['short'] !== null )
        <main {!!$styles['sections']['background']!!} class="flex w-full lg:w-full justify-between items-center mb-6 border border-gray-300 rounded-md shadow-md p-6">
            <h1 class="text-2xl font-semibold text-gray-600">Redirects of {{$params['short']}}</h1>
            <a
                class="flex relative h-10 outline-none rounded-md bg-background px-3 py-2 text-sm"
                href="{{url('stats')}}"
                >
                <svg class="h-8 w-8 text-gray-500"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                  </svg>
                <svg class="h-8 w-8 text-red-500 absolute top-1/2 right-0"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
                                  
            </a>
        </main>
        @endif
        <section class="flex flex-col lg:flex-row justify-center gap-1 lg:justify-between mb-6 w-full">
            <article class="rounded-lg shadow-lg bg-blue-700 w-full text-gray-100 font-bold">
                <div class="p-6 w-full">
                    {{-- Get the total users registered since last week --}}
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm">NEW USERS</p>
                            <p class="text-3xl flex flex-row mt-1 font-semibold">
                                <span>{{ $users->users_registered_this_month }}</span>
                                @if ($users->users_registered_last_month > $users->users_registered_this_month)
                                    {!! Icons::Icon('icon-arrow-down') !!}
                                @else
                                    {!! Icons::Icon('icon-arrow-up') !!}
                                @endif
                            </p>
                            <p class="text-sm mt-1 font-semibold">Last month:{{ $users->users_registered_last_month }}
                            </p>
                            <p class="text-sm mt-3 font-semibold">

                                @if ($users->users_registered_last_month > $users->users_registered_this_month)
                                    <span class="text-red-500 text-xl font-semibold">
                                    @else
                                        <span class="text-green-500 text-xl font-semibold">
                                @endif
                                {{ $users->percentage_change }}
                                </span>
                                Since last month
                            </p>
                        </div>
                    </div>
                </div>
            </article>
            <article class="rounded-lg shadow-lg text-gray-100 w-full font-bold" style="background:#f97316">
                <div class="p-6">
                    {{-- Get the total users registered since last week --}}
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm">REDIRECTS OF SHORTS</p>
                            <p class="text-3xl flex flex-row mt-1 font-semibold">
                                <span>{{ $redirects['yesterday']->Today }}</span>
                                @if ($redirects['yesterday']->Yesterday > $redirects['yesterday']->Today)
                                    {!! Icons::Icon('icon-arrow-down') !!}
                                @else
                                    {!! Icons::Icon('icon-arrow-up') !!}
                                @endif
                            </p>
                            <p class="text-sm mt-1 font-semibold">Yesterday:{{ $redirects['yesterday']->Yesterday }}
                            </p>
                            <p class="text-sm mt-3 font-semibold">

                                @if ($redirects['yesterday']->Yesterday > $redirects['yesterday']->Today)
                                    <span class="text-red-500 text-xl font-semibold">
                                    @else
                                        <span class="text-green-500 text-xl font-semibold">
                                @endif
                                {{ $redirects['yesterday']->percentage_change }}
                                </span>
                                Since yesterday
                            </p>
                        </div>
                    </div>
                </div>
            </article>
            <article class="rounded-lg shadow-lg text-gray-100 w-full font-bold" style="background:#80378b">
                <div class="p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm">REDIRECTS OF SHORT LAST MONTHS</p>
                            <p class="text-3xl flex flex-row mt-1 font-semibold">
                                <span>{{ $redirects['last_month']->ThisMonth }}</span>
                                @if ($redirects['last_month']->LastMonth > $redirects['last_month']->ThisMonth)
                                    {!! Icons::Icon('icon-arrow-down') !!}
                                @else
                                    {!! Icons::Icon('icon-arrow-up') !!}
                                @endif
                            </p>
                            <p class="text-sm mt-1 font-semibold">Last month:{{ $redirects['last_month']->LastMonth }}
                            </p>
                            <p class="text-sm mt-3 font-semibold">

                                @if ($redirects['last_month']->LastMonth > $redirects['last_month']->ThisMonth)
                                    <span class="text-red-500 text-xl font-semibold">
                                    @else
                                        <span class="text-green-500 text-xl font-semibold">
                                @endif
                                {{ $redirects['last_month']->percentage_change }}
                                </span>
                                Since last month
                            </p>
                        </div>
                    </div>
                </div>
            </article>
        </section>
        <section class="flex flex-1 flex-col lg:flex-row justify-center lg:justify-around gap-4 w-full mb-6">
            <article {!!$styles['sections']['background']!!} class="rounded-lg border bg-card text-card-foreground shadow-md w-full h-full">
                <div class="flex flex-col p-6">
                    <h3 class="text-2xl font-semibold whitespace-nowrap leading-none tracking-tight">Overview redirects
                        on {{ $date['previous']['month'] }} {{ $date['current']['month'] }} in
                        {{ $date['current']['year'] }}</h3>
                    <p class="text-sm text-muted-foreground">Sales value</p>
                </div>
                <div class="p-6">
                    <div class="w-full">
                        <div style="position: relative;">
                            <canvas id="myChart" height="400"></canvas>
                        </div>
                    </div>
                </div>
            </article>
            <article {!!$styles['sections']['background']!!} class="rounded-lg border bg-card text-card-foreground shadow-md w-full h-full">
                <div class="flex flex-col p-6">
                    <h3 class="text-2xl font-semibold whitespace-nowrap leading-none tracking-tight">Overview total redirects
                        in {{ $date['current']['year'] }}</h3>
                    <p class="text-sm text-muted-foreground">Sales value</p>
                </div>
                <div class="p-6">
                    <div class="w-full h-[300px]">
                        
                        <div style="position: relative;">
                            <canvas id="myChart1" height="215"></canvas>
                        </div>
                      
                    </div>
                </div>
            </article>
        </section>
        <section class="flex col justify-center w-full">
            <div {!!$styles['sections']['background']!!} class="rounded-lg border bg-card text-card-foreground shadow-md w-full">
                <div class="flex flex-col space-y-1.5 p-6">
                    <h3 class="text-2xl text-gray-600 dark:text-gray-200 font-semibold whitespace-nowrap leading-none tracking-tight">Page
                        visited by shorts</h3>
                </div>
                <div class="p-6 min-w-[350px]">
                {{-- Table page visited by shorts --}}
                    {{-- Table for pc --}}
                    <div class="relative hidden lg:block w-full">
                        <table class="w-full caption-bottom text-sm">
                            <thead class="[&amp;_tr]:border-b bg-blue-500">
                                <tr class="border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted">
                                    <th
                                        class="h-12 px-4 text-left align-middle font-medium text-muted-foreground text-gray-100 text-lg [&amp;:has([role=checkbox])]:pr-0">
                                        Page Name
                                    </th>
                                    <th
                                        class="h-12 px-4 text-left align-middle font-medium text-muted-foreground text-gray-100 text-lg [&amp;:has([role=checkbox])]:pr-0">
                                        Short
                                    </th>
                                    <th
                                        class="h-12 px-4 text-left align-middle font-medium text-muted-foreground text-gray-100 text-lg [&amp;:has([role=checkbox])]:pr-0">
                                        Viewers
                                    </th>
                                    <th
                                        class="h-12 px-4 text-left align-middle font-medium text-muted-foreground text-gray-100 text-lg [&amp;:has([role=checkbox])]:pr-0">
                                        Only users
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="[&amp;_tr:last-child]:border-0">
                                @foreach ($redirects['getRedirectsTotalAndByUser'] as $redirect)
                                    <tr class="border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted">
                                        <td class="p-4 align-middle [&amp;:has([role=checkbox])]:pr-0">{{ $redirect->url }}
                                        </td>
                                        <td class="p-4 align-middle [&amp;:has([role=checkbox])]:pr-0">
                                            {{ $redirect->short }}</td>
                                        <td class="p-4 align-middle [&amp;:has([role=checkbox])]:pr-0">
                                            {{ $redirect->total_redirects_shorts }}</td>
                                        <td class="p-4 align-middle [&amp;:has([role=checkbox])]:pr-0">
                                            {{ $redirect->total_redirects_users }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{-- Table for tablet and mobile --}}
                    <div class="relative block lg:hidden w-full">
                        <table class="w-full caption-bottom text-sm">
                            <tbody class="[&amp;_tr:last-child]:border-0 relative">
                                @foreach ($redirects['getRedirectsTotalAndByUser'] as $redirect)
                                    <tr>
                                        <th
                                            class="h-12 px-4 text-center align-center font-medium text-muted-foreground text-gray-500 text-lg [&amp;:has([role=checkbox])]:pr-0">
                                            Page name
                                        </th>
                                        <td class="p-4 align-center [&amp;:has([role=checkbox])]:pr-0">{{ $redirect->url }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th
                                            class="h-12 px-4 text-center align-center font-medium text-muted-foreground text-gray-500 text-lg [&amp;:has([role=checkbox])]:pr-0">
                                            Short
                                        </th>
                                        <td class="p-4 align-center [&amp;:has([role=checkbox])]:pr-0">{{ $redirect->short }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th
                                        class="h-12 px-4 text-center align-center font-medium text-muted-foreground text-gray-500 text-lg [&amp;:has([role=checkbox])]:pr-0">
                                        Viewers
                                        </th>
                                        <td class="p-4 align-center [&amp;:has([role=checkbox])]:pr-0">{{ $redirect->total_redirects_shorts }}
                                        </td>
                                    </tr>
                                    <tr
                                        class="relative after:absolute after:bottom-0 after:h-3 after:w-full after:text-black after:content:'' after:bg-gray-700 after:z-50">
                                        <th
                                        class="h-12 px-4 text-center align-center font-medium text-muted-foreground text-gray-500 text-lg [&amp;:has([role=checkbox])]:pr-0">
                                        Only users
                                        </th>
                                        <td class="p-4 align-center [&amp;:has([role=checkbox])]:pr-0">{{ $redirect->total_redirects_users }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><hr class="border-t border-gray-300"/></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <nav role="navigation" aria-label="pagination" class="mx-auto flex w-full justify-center mt-5">
                        <ul class="flex flex-row items-center gap-1">
                            <!-- Previous page link -->
                            <li>
                                <a href="{{ $redirects['getRedirectsTotalAndByUser']->previousPageUrl() }}"
                                    class="pagination-link">&laquo; Previous</a>
                            </li>
                            <!-- Pagination elements -->
                            @for ($i = 1; $i <= $redirects['getRedirectsTotalAndByUser']->lastPage(); $i++)
                                <li>
                                    <a href="{{ $redirects['getRedirectsTotalAndByUser']->url($i) }}"
                                        class="pagination-link{{ $i == $redirects['getRedirectsTotalAndByUser']->currentPage() ? ' active' : '' }}">{{ $i }}</a>
                                </li>
                            @endfor
                            <!-- Next page link -->
                            <li>
                                <a href="{{ $redirects['getRedirectsTotalAndByUser']->nextPageUrl() }}"
                                    class="pagination-link">Next &raquo;</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </section>
        <script type="module" defer>

            // Generate a pie chart about redirects by last months. 
            generateChartRedirectsMonth( 
                [ '{{$date["previous"]["month"]}}' , '{{$date["current"]["month"]}}'] 
                , 
                [
                    {
                        label: [ '{{$date["previous"]["month"]}}', '{{$date["current"]["month"]}}' ],
                        data: [ "{{$redirects['last_month']->LastMonth}}" , "{{$redirects['last_month']->ThisMonth}}" ],
                        color: ['rgb(255, 99, 132)', 'rgb(54, 162, 235)']
                    }
                ]
            );
            generateChartViewersAndUsers(
                @json($redirects['chart']['shorts']),
                @json($redirects['chart']['viewersData']),
                @json($redirects['chart']['usersData']),
            );
        </script>
@endsection
