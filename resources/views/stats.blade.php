@extends('dashboard')

@section('title', 'Stats')

@section('main-content')
    <div class="flex flex-col justify-center items-center w-full mt-10 lg:ml-24 xl:mx-auto">
        <div class="p-10">
            <div class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-3 gap-4 mb-6">
                <div class="rounded-lg border shadow-lg bg-blue-700 text-gray-100 font-bold">
                    <div class="p-6">
                        {{-- Get the total users registered since last week --}}
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm">NEW USERS</p>
                                <p class="text-3xl flex flex-row mt-1 font-semibold">
                                    <span>{{ $users->users_registered_this_month }}</span>
                                    @if ($users->users_registered_last_month > $users->users_registered_this_month)
                                        {!!$svgDownArrow!!}
                                    @else
                                        {!!$svgUpArrow!!}
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
                </div>
                <div class="rounded-lg border shadow-lg text-gray-100 font-bold" style="background:#f97316">
                    <div class="p-6">
                        {{-- Get the total users registered since last week --}}
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm">REDIRECTS OF SHORTS</p>
                                <p class="text-3xl flex flex-row mt-1 font-semibold">
                                    <span>{{ $redirects['yesterday']->Today }}</span>
                                    @if ($redirects['yesterday']->Yesterday > $redirects['yesterday']->Today)
                                        {!!$svgDownArrow!!}
                                    @else
                                        {!!$svgUpArrow!!}
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
                </div>
                <div class="rounded-lg border shadow-lg text-gray-100 font-bold" style="background:#80378b">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm">SHORTS GENERATED</p>
                                <p class="text-3xl flex flex-row mt-1 font-semibold">
                                    <span>{{ $redirects['last_month']->ThisMonth }}</span>
                                    @if ($redirects['last_month']->LastMonth > $redirects['last_month']->ThisMonth)
                                        {!!$svgDownArrow!!}
                                    @else
                                        {!!$svgUpArrow!!}
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
                </div>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mb-6">
                <div class="rounded-lg border bg-card text-card-foreground shadow-sm">
                    <div class="flex flex-col space-y-1.5 p-6">
                        <h3 class="text-2xl font-semibold whitespace-nowrap leading-none tracking-tight">Overview redirects
                            on {{$date['previous']['month']}} {{$date['current']['month']}} in {{$date['current']['year']}}</h3>
                        <p class="text-sm text-muted-foreground">Sales value</p>
                    </div>
                    <div class="p-6">
                        <div class="w-full h-[300px]">
                            <div style="width: 100%; height: 100%;">
                                <div style="position: relative;">
                                    <canvas id="myChart" height="300"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="rounded-lg border bg-card text-card-foreground shadow-sm">
                    <div class="flex flex-col space-y-1.5 p-6">
                        <h3 class="text-2xl font-semibold whitespace-nowrap leading-none tracking-tight">Overview shorts
                            generated in {{ date('Y') }}</h3>
                        <p class="text-sm text-muted-foreground">Total shorts generated</p>
                    </div>
                    <div class="p-6">
                        <div class="w-full h-[300px]">
                            <div style="width: 100%; height: 100%;">
                                <div style="position: relative;">
                                    {{-- Performance --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-1 gap-4">
                <div class="rounded-lg border bg-card text-card-foreground shadow-sm">
                    <div class="flex flex-col space-y-1.5 p-6">
                        <h3 class="text-2xl text-gray-600 font-semibold whitespace-nowrap leading-none tracking-tight">Page visited by shorts</h3>
                    </div>
                    <div class="p-6">
                        <div class="relative w-full">
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
                                    @foreach ( $redirects['getRedirectsTotalAndByUser'] as $redirect )
                                        <tr
                                            class="border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted">
                                            <td class="p-4 align-middle [&amp;:has([role=checkbox])]:pr-0">{{$redirect->url}}</td>
                                            <td class="p-4 align-middle [&amp;:has([role=checkbox])]:pr-0">{{$redirect->short}}</td>
                                            <td class="p-4 align-middle [&amp;:has([role=checkbox])]:pr-0">{{$redirect->total_redirects_shorts}}</td>
                                            <td class="p-4 align-middle [&amp;:has([role=checkbox])]:pr-0">{{$redirect->total_redirects_users}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                
                            </table>
                        </div>
                        <nav role="navigation" aria-label="pagination" class="mx-auto flex w-full justify-center mt-5">
                            <ul class="flex flex-row items-center gap-1">
                                <!-- Previous page link -->
                                  <li>
                                      <a href="{{ $redirects['getRedirectsTotalAndByUser']->previousPageUrl() }}" class="pagination-link">&laquo; Previous</a>
                                  </li>
                                <!-- Pagination elements -->
                                @for ($i = 1; $i <= $redirects['getRedirectsTotalAndByUser']->lastPage(); $i++)
                                  <li>
                                      <a href="{{ $redirects['getRedirectsTotalAndByUser']->url($i) }}" class="pagination-link{{ ($i == $redirects['getRedirectsTotalAndByUser']->currentPage()) ? ' active' : '' }}">{{ $i }}</a>
                                  </li>
                                @endfor
                                <!-- Next page link -->
                                  <li>
                                      <a href="{{ $redirects['getRedirectsTotalAndByUser']->nextPageUrl() }}" class="pagination-link">Next &raquo;</a>
                                  </li>  
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['January', 'February', 'March', 'April', 'May'],
                datasets: [{
                    label: 'Dataset 1',
                    data: [65, 59, 80, 81, 56],
                    fill: false,
                    borderColor: 'rgb(75, 192, 192)',
                    tension: 0.1
                }, {
                    label: 'Dataset 2',
                    data: [28, 48, 40, 19, 86],
                    fill: false,
                    borderColor: 'rgb(255, 99, 132)',
                    tension: 0.1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endsection
