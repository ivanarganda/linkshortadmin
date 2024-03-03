@extends('dashboard')

@section('title', 'Users')

@section('main-content')
<div class="flex flex-col justify-center items-center w-full mt-2 xl:mx-auto">
  <main class="flex w-full lg:w-3/4 justify-between items-center mt-16 mb-6">
    <h1 class="text-2xl font-semibold text-gray-600">List of users registered</h1>
    <input
        class="flex h-10 outline-none rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 w-48 md:w-64"
        placeholder="Filter users..."
        type="search"
    />
  </main>
  <section class="relative flex w-full lg:w-3/4 shadow-xl">
      <table class="w-full caption-bottom text-sm flex-grow">
          <thead class="[&amp;_tr]:border-b bg-red-100">
              <tr class="border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted">
                  <th
                      class="h-12 px-4 text-left text-lg text-gray-700 align-middle font-medium font-bold text-muted-foreground [&amp;:has([role=checkbox])]:pr-0"
                  >
                      Name
                  </th>
                  <th
                      class="h-12 px-4 text-left text-lg text-gray-700 align-middle font-medium font-bold text-muted-foreground [&amp;:has([role=checkbox])]:pr-0"
                  >
                      Email
                  </th>
                  <th
                      class="h-12 px-4 text-left text-lg text-gray-700 align-middle font-medium font-bold text-muted-foreground [&amp;:has([role=checkbox])]:pr-0"
                  >
                      Role
                  </th>
                  <th
                      class="h-12 px-4 text-left text-lg text-gray-700 align-middle font-medium font-bold text-muted-foreground [&amp;:has([role=checkbox])]:pr-0"
                  >
                      Registered
                  </th>
              </tr>
          </thead>
          <tbody class="[&amp;_tr:last-child]:border-0">
              @foreach ($users as $user)
              <tr class="border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted">
                  <td class="p-4 text-gray-600 align-middle [&amp;:has([role=checkbox])]:pr-0">{{$user->name}}</td>
                  <td class="p-4 text-gray-600 align-middle [&amp;:has([role=checkbox])]:pr-0">{{$user->email}}</td>
                  <td class="p-4 text-gray-600 align-middle [&amp;:has([role=checkbox])]:pr-0">{{$user->type}}</td>
                  <td class="p-4 text-gray-600 align-middle [&amp;:has([role=checkbox])]:pr-0">{{$user->registration_date}}</td>
              </tr>
              @endforeach
          </tbody>
      </table>
  </section>
  <section class="flex mt-10 mb-5 w-full lg:w-3/4 h-96">
      <canvas class="h-full" id="myChart"></canvas>
  </section>
  <nav role="navigation" aria-label="pagination" class="mx-auto flex w-full justify-center mt-auto">
      <ul class="flex flex-row items-center gap-1">
          <!-- Previous page link -->
            <li>
                <a href="{{ $users->previousPageUrl() }}" class="pagination-link">&laquo; Previous</a>
            </li>
          <!-- Pagination elements -->
          @for ($i = 1; $i <= $users->lastPage(); $i++)
            <li>
                <a href="{{ $users->url($i) }}" class="pagination-link{{ ($i == $users->currentPage()) ? ' active' : '' }}">{{ $i }}</a>
            </li>
          @endfor
          <!-- Next page link -->
            <li>
                <a href="{{ $users->nextPageUrl() }}" class="pagination-link">Next &raquo;</a>
            </li>  
      </ul>
  </nav>
</div>
<script>
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line', // Change this to 'bar', 'pie', etc. based on your need
        data: {
            labels: @json($labels),
            datasets: [{
                label: 'Registered Users',
                data: @json($data),
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive:true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1, // Ensure y-axis values are integers
                        callback: function(value, index, values) {
                            return Math.floor(value); // Display integer values only
                        }
                    }
                }
            }
        }
    });
</script>
@endsection
