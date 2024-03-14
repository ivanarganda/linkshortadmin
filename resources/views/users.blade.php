@extends('dashboard')

@section('title', 'Users')

@section('main-content')
    <div class="flex flex-col justify-center items-center w-full mt-20 lg:mt-20 xl:mx-auto">
        @include('form.modal')
        <main {!! $styles['sections']['background'] !!}
            class="flex w-full lg:w-3/4 justify-between items-center -mt-10 mb-6 border border-gray-300 rounded-md shadow-md p-6">
            <h1 class="text-2xl font-semibold text-gray-600">List of users registered</h1>
            <div class="relative pl-10 flex justify items-center">
                <form class="p-0 m-0" method="GET" action="{{url('users')}}">
                    <label for="search" class="absolute top-0 left-0 cursor-pointer">
                        {!!Icons::Icon('icon-search')!!}
                    </label>
                    <input
                        class="flex h-10 outline-none rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 w-48 md:w-64"
                        placeholder="Filter users..." name="search" type="search" />
                    <input hidden type="submit" id="search"/>
                </form>
            </div>
        </main>
        <section {!! $styles['sections']['background'] !!}
            class="flex mt-1 mb-5 w-full lg:w-3/4 h-96 border border-gray-300 rounded-md shadow-md p-6">
            <canvas class="h-full" id="myChart"></canvas>
        </section>
        <section {!! $styles['sections']['background'] !!}
            class="relative hidden lg:block w-full rounded-lg lg:w-3/4 border border-gray-300 rounded-md shadow-md p-6">
            <table id="table-users" class="w-full caption-bottom text-sm flex-grow">
                <thead class="bg-blue-500">
                    <tr class="border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted">
                        <th
                            class="h-12 px-4 text-left text-lg text-gray-100 align-middle font-medium font-bold text-muted-foreground [&amp;:has([role=checkbox])]:pr-0">
                            Name
                        </th>
                        <th
                            class="h-12 px-4 text-left text-lg text-gray-100 align-middle font-medium font-bold text-muted-foreground [&amp;:has([role=checkbox])]:pr-0">
                            Email
                        </th>
                        <th
                            class="h-12 px-4 text-left text-lg text-gray-100 align-middle font-medium font-bold text-muted-foreground [&amp;:has([role=checkbox])]:pr-0">
                            Role
                        </th>
                        <th
                            class="h-12 px-4 text-left text-lg text-gray-100 align-middle font-medium font-bold text-muted-foreground [&amp;:has([role=checkbox])]:pr-0">
                            Registered
                        </th>
                        <th></th>
                    </tr>
                </thead>
                <tbody class="[&_tr:last-child]:border-0">
                    @foreach ($users as $user)
                    <tr id="{{ $user->email }}" class="border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted">
                        <td class="p-4 text-gray-600 align-middle [&:has([role=checkbox])]:pr-0">{{ $user->name }}</td>
                        <td class="p-4 text-gray-600 align-middle [&:has([role=checkbox])]:pr-0">{{ $user->email }}</td>
                        <td class="p-4 text-gray-600 align-middle [&:has([role=checkbox])]:pr-0">{{ $user->type }}</td>
                        <td class="p-4 text-gray-600 align-middle [&:has([role=checkbox])]:pr-0">{{ $user->registration_date }}</td>
                        <td class="p-4 text-gray-600 align-middle [&:has([role=checkbox])]:pr-0">
                            <label class="cursor-pointer" for="edit{{$user->id}}">{!!Icons::Icon('icon-edit')!!}</label>
                            <input hidden type="button" onclick="window.location.href = '{{ url('users?data=' . base64_encode(json_encode([
                                'id' => $user->id,
                                'name' => $user->name,
                                'email' => $user->email,
                                'type' => $user->type,
                                'created_at' => $user->registration_date,
                                'updated_at' => $user->updated_at,
                            ]))) }}'" id="edit{{$user->id}}" value="Edit" />
                        </td>
                    </tr>
                    @endforeach
                </tbody>                
            </table>
        </section>
        <section {!! $styles['sections']['background'] !!}
            class="relative block lg:hidden w-full rounded-lg lg:w-3/4 border border-gray-300 rounded-md shadow-md p-6">
            <table id="table-users-mobile" class="w-full caption-bottom text-sm">
                <tbody class="[&amp;_tr:last-child]:border-0 relative">
                    @foreach ($users as $user)
                        <tr>
                            <th
                                class="h-12 px-4 text-center align-center font-medium text-muted-foreground text-gray-500 text-lg [&amp;:has([role=checkbox])]:pr-0">
                                Name
                            </th>
                            <td class="p-4 align-center [&amp;:has([role=checkbox])]:pr-0">{{ $user->name }}
                            </td>
                        </tr>
                        <tr>
                            <th
                                class="h-12 px-4 text-center align-center font-medium text-muted-foreground text-gray-500 text-lg [&amp;:has([role=checkbox])]:pr-0">
                                Email
                            </th>
                            <td class="p-4 align-center [&amp;:has([role=checkbox])]:pr-0">{{ $user->email }}
                            </td>
                        </tr>
                        <tr>
                            <th
                                class="h-12 px-4 text-center align-center font-medium text-muted-foreground text-gray-500 text-lg [&amp;:has([role=checkbox])]:pr-0">
                                Role
                            </th>
                            <td class="p-4 align-center [&amp;:has([role=checkbox])]:pr-0">{{ $user->type }}
                            </td>
                        </tr>
                        <tr
                            class="relative after:absolute after:bottom-0 after:h-3 after:w-full after:text-black after:content:'' after:bg-gray-700 after:z-50">
                            <th
                                class="h-12 px-4 text-center align-center font-medium text-muted-foreground text-gray-500 text-lg [&amp;:has([role=checkbox])]:pr-0">
                                Registered
                            </th>
                            <td class="p-4 align-center [&amp;:has([role=checkbox])]:pr-0">{{ $user->registration_date }}
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <hr class="border-t border-gray-300" />
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>
        <nav role="navigation" aria-label="pagination" class="mx-auto flex w-full justify-center mt-6">
            <ul class="flex flex-row items-center gap-1">
                <!-- Previous page link -->
                <li>
                    <a href="{{ $users->previousPageUrl() }}" class="pagination-link">&laquo; Previous</a>
                </li>
                <!-- Pagination elements -->
                @for ($i = 1; $i <= $users->lastPage(); $i++)
                    <li>
                        <a href="{{ $users->url($i) }}"
                            class="pagination-link{{ $i == $users->currentPage() ? ' active' : '' }}">{{ $i }}</a>
                    </li>
                @endfor
                <!-- Next page link -->
                <li>
                    <a href="{{ $users->nextPageUrl() }}" class="pagination-link">Next &raquo;</a>
                </li>
            </ul>
        </nav>
    </div>
    <script type="module" defer>
        generateChart(
            'Users registered',
            @json($labels),
            @json($data)
        );
    </script>
@endsection
