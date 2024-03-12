@extends('dashboard')

@section('title', 'Shorts')

@section('main-content')
<div class="flex flex-col justify-center items-center w-full mt-20 lg:mt-10 xl:mx-auto">
  <main {!!$styles['sections']['background']!!} class="flex w-full lg:w-3/4 justify-between items-center -mt-10 mb-6 rounded-md shadow-md p-6">
    <h1 class="text-2xl font-semibold text-gray-600">List of shorts generated</h1>
    <input
        class="flex h-10 outline-none rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 w-48 md:w-64"
        placeholder="Filter shorts..."
        type="search"
    />
  </main>
  <section {!!$styles['sections']['background']!!} class="relative flex rounded-lg w-full lg:w-3/4 shadow-xl rounded-md shadow-md p-6">
      <table class="w-full caption-bottom text-sm flex-grow">
          <thead class="bg-blue-500">
              <tr class="border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted">
                  <th
                      class="h-12 px-4 text-left text-lg text-gray-100 align-middle font-medium font-bold text-muted-foreground [&amp;:has([role=checkbox])]:pr-0"
                  >
                      Short
                  </th>
                  <th
                      class="h-12 px-4 text-left text-lg text-gray-100 align-middle font-medium font-bold text-muted-foreground [&amp;:has([role=checkbox])]:pr-0"
                  >
                      Source short
                  </th>
                  <th
                      class="h-12 px-4 text-left text-lg text-gray-100 align-middle font-medium font-bold text-muted-foreground [&amp;:has([role=checkbox])]:pr-0"
                  >
                      Description
                  </th>
                  <th
                      class="h-12 px-4 text-left text-lg text-gray-100 align-middle font-medium font-bold text-muted-foreground [&amp;:has([role=checkbox])]:pr-0"
                  >
                      Generated
                  </th>
              </tr>
          </thead>
          <tbody class="[&amp;_tr:last-child]:border-0">
              @foreach ($urls as $url)
              <tr class="border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted">
                  <td class="p-4 text-gray-600 align-middle [&amp;:has([role=checkbox])]:pr-0">{{$url->url}}</td>
                  <td class="p-4 text-gray-600 align-middle [&amp;:has([role=checkbox])]:pr-0">{{$url->short}}</td>
                  <td class="p-4 text-gray-600 align-middle [&amp;:has([role=checkbox])]:pr-0">{{$url->description}}</td>
                  <td class="p-4 text-gray-600 align-middle [&amp;:has([role=checkbox])]:pr-0">{{$url->registration_date}}</td>
              </tr>
              @endforeach
          </tbody>
      </table>
  </section>
  <section {!!$styles['sections']['background']!!} class="flex mt-10 mb-5 w-full lg:w-3/4 h-96 rounded-md shadow-md p-6">
      <canvas class="h-full" id="myChart"></canvas>
  </section>
  <nav role="navigation" aria-label="pagination" class="mx-auto flex w-full justify-center mt-auto">
      <ul class="flex flex-row items-center gap-1">
          <!-- Previous page link -->
            <li>
                <a href="{{ $urls->previousPageUrl() }}" class="pagination-link">&laquo; Previous</a>
            </li>
          <!-- Pagination elements -->
          @for ($i = 1; $i <= $urls->lastPage(); $i++)
            <li>
                <a href="{{ $urls->url($i) }}" class="pagination-link{{ ($i == $urls->currentPage()) ? ' active' : '' }}">{{ $i }}</a>
            </li>
          @endfor
          <!-- Next page link -->
            <li>
                <a href="{{ $urls->nextPageUrl() }}" class="pagination-link">Next &raquo;</a>
            </li>  
      </ul>
  </nav>
</div>
<script type="module" defer>
    generateChart(
        'Linkshorts generated'
        , 
        @json($labels)
        , 
        @json($data)
    );
</script>
@endsection
