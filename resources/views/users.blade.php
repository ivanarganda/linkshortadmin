@extends('dashboard')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

@section('title','Users')

@section('main-content')
  <main class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-semibold">Users</h1>
    <input
      class="flex h-10 rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 w-64"
      placeholder="Filter users..."
      type="search"
    />
  </main>
  <section class="relative w-full">
    <table class="w-full caption-bottom text-sm flex-grow">
      <thead class="[&amp;_tr]:border-b">
        <tr class="border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted">
          <th class="h-12 px-4 text-left align-middle font-medium text-muted-foreground [&amp;:has([role=checkbox])]:pr-0">
            Name
          </th>
          <th class="h-12 px-4 text-left align-middle font-medium text-muted-foreground [&amp;:has([role=checkbox])]:pr-0">
            Email
          </th>
          <th class="h-12 px-4 text-left align-middle font-medium text-muted-foreground [&amp;:has([role=checkbox])]:pr-0">
            Role
          </th>
          <th class="h-12 px-4 text-left align-middle font-medium text-muted-foreground [&amp;:has([role=checkbox])]:pr-0">
            Status
          </th>
        </tr>
      </thead>
      <tbody class="[&amp;_tr:last-child]:border-0">
        <tr class="border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted">
          <td class="p-4 align-middle [&amp;:has([role=checkbox])]:pr-0">John Doe</td>
          <td class="p-4 align-middle [&amp;:has([role=checkbox])]:pr-0">john.doe@example.com</td>
          <td class="p-4 align-middle [&amp;:has([role=checkbox])]:pr-0">Admin</td>
          <td class="p-4 align-middle [&amp;:has([role=checkbox])]:pr-0">Active</td>
        </tr>
        <tr class="border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted">
          <td class="p-4 align-middle [&amp;:has([role=checkbox])]:pr-0">Jane Smith</td>
          <td class="p-4 align-middle [&amp;:has([role=checkbox])]:pr-0">jane.smith@example.com</td>
          <td class="p-4 align-middle [&amp;:has([role=checkbox])]:pr-0">User</td>
          <td class="p-4 align-middle [&amp;:has([role=checkbox])]:pr-0">Inactive</td>
        </tr>
        <tr class="border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted">
          <td class="p-4 align-middle [&amp;:has([role=checkbox])]:pr-0">Emma Johnson</td>
          <td class="p-4 align-middle [&amp;:has([role=checkbox])]:pr-0">emma.johnson@example.com</td>
          <td class="p-4 align-middle [&amp;:has([role=checkbox])]:pr-0">User</td>
          <td class="p-4 align-middle [&amp;:has([role=checkbox])]:pr-0">Active</td>
        </tr>
        <tr class="border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted">
          <td class="p-4 align-middle [&amp;:has([role=checkbox])]:pr-0">Robert Brown</td>
          <td class="p-4 align-middle [&amp;:has([role=checkbox])]:pr-0">robert.brown@example.com</td>
          <td class="p-4 align-middle [&amp;:has([role=checkbox])]:pr-0">Admin</td>
          <td class="p-4 align-middle [&amp;:has([role=checkbox])]:pr-0">Active</td>
        </tr>
        <tr class="border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted">
            <td class="p-4 align-middle [&amp;:has([role=checkbox])]:pr-0">Robert Brown</td>
            <td class="p-4 align-middle [&amp;:has([role=checkbox])]:pr-0">robert.brown@example.com</td>
            <td class="p-4 align-middle [&amp;:has([role=checkbox])]:pr-0">Admin</td>
            <td class="p-4 align-middle [&amp;:has([role=checkbox])]:pr-0">Active</td>
        </tr>
        <tr class="border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted">
        <td class="p-4 align-middle [&amp;:has([role=checkbox])]:pr-0">Robert Brown</td>
        <td class="p-4 align-middle [&amp;:has([role=checkbox])]:pr-0">robert.brown@example.com</td>
        <td class="p-4 align-middle [&amp;:has([role=checkbox])]:pr-0">Admin</td>
        <td class="p-4 align-middle [&amp;:has([role=checkbox])]:pr-0">Active</td>
        </tr>
      </tbody>
    </table>
  </section>
  <section class="w-full mt-10 md:w-3/4 lg:w-full mx-auto">
    <canvas id="myChart" height="400"></canvas>
  </section>
  <nav role="navigation" aria-label="pagination" class="mx-auto flex w-full justify-center mt-auto">
    <ul class="flex flex-row items-center gap-1">
      <li class="">
        <li class="">
          <a
            class="inline-flex items-center whitespace-nowrap shrink-0 justify-center rounded-md text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 text-gray-500 hover:bg-gray-100 hover:text-gray-900 h-8 px-3 py-2 gap-1 pl-2.5"
            aria-label="Go to previous page"
            href="#"
          >
            <svg
              xmlns="http://www.w3.org/2000/svg"
              width="24"
              height="24"
              viewBox="0 0 24 24"
              fill="none"
              stroke="currentColor"
              stroke-width="2"
              stroke-linecap="round"
              stroke-linejoin="round"
              class="h-4 w-4"
            >
              <path d="m15 18-6-6 6-6"></path>
            </svg>
            <span>Previous</span>
          </a>
        </li>
      </li>
      <li class="">
        <li class="">
          <a
            class="inline-flex items-center whitespace-nowrap shrink-0 justify-center rounded-md text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 text-gray-500 hover:bg-gray-100 hover:text-gray-900 h-9 w-9"
            href="#"
          >
            1
          </a>
        </li>
      </li>
      <li class="">
        <li class="">
          <a
            aria-current="page"
            class="inline-flex items-center whitespace-nowrap shrink-0 justify-center rounded-md text-sm transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 border border-input bg-background shadow-sm font-medium hover:bg-accent hover:text-accent-foreground h-9 w-9"
            href="#"
          >
            2
          </a>
        </li>
      </li>
      <li class="">
        <li class="">
          <a
            class="inline-flex items-center whitespace-nowrap shrink-0 justify-center rounded-md text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 text-gray-500 hover:bg-gray-100 hover:text-gray-900 h-9 w-9"
            href="#"
          >
            3
          </a>
        </li>
      </li>
      <li class="">
        <span aria-hidden="true" class="flex h-9 w-9 items-center justify-center">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            width="24"
            height="24"
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            stroke-width="2"
            stroke-linecap="round"
            stroke-linejoin="round"
            class="h-4 w-4"
          >
            <circle cx="12" cy="12" r="1"></circle>
            <circle cx="19" cy="12" r="1"></circle>
            <circle cx="5" cy="12" r="1"></circle>
          </svg>
          <span class="sr-only">More pages</span>
        </span>
      </li>
      <li class="">
        <li class="">
          <a
            class="inline-flex items-center whitespace-nowrap shrink-0 justify-center rounded-md text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 text-gray-500 hover:bg-gray-100 hover:text-gray-900 h-8 px-3 py-2 gap-1 pr-2.5"
            aria-label="Go to next page"
            href="#"
          >
            <span>Next</span>
            <svg
              xmlns="http://www.w3.org/2000/svg"
              width="24"
              height="24"
              viewBox="0 0 24 24"
              fill="none"
              stroke="currentColor"
              stroke-width="2"
              stroke-linecap="round"
              stroke-linejoin="round"
              class="h-4 w-4"
            >
              <path d="m9 18 6-6-6-6"></path>
            </svg>
          </a>
        </li>
      </li>
    </ul>
  </nav>
  <script>
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line', // Change this to 'bar', 'pie', etc. based on your need
        data: {
            labels: @json($labels),
            datasets: [{
                label: 'Sample Data',
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
                    beginAtZero: true
                }
            }
        }
    });
</script>
@endsection