@extends('dashboard')

@section('title', 'Users')

@section('main-content')
<!-- Start Container -->
<div class="container mx-auto p-4">
  
  <div class="flex flex-col justify-center items-center ml-auto lg:ml-40 mt-20 w-full">
    <main {!! $styles['sections']['background'] !!} class="flex w-full lg:w-4/5 justify-between items-center -mt-10 mb-6 rounded-md shadow-md p-6">
      <h1 class="text-2xl font-semibold text-gray-600">List of users registered</h1>
      <input
          class="flex h-10 outline-none rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 w-48 md:w-64"
          placeholder="Filter users..."
          type="search"
      />
    </main>
    <section {!! $styles['sections']['background'] !!} class="flex mt-10 mb-5 w-full lg:w-4/5 h-96 rounded-md shadow-md p-6">
      <canvas class="h-full" id="myChart"></canvas>
    </section>
    {!! $table !!}
    {!! $pagination !!}
  </div>

</div>
<!-- End Container -->

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
