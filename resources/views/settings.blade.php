@extends('dashboard')

@section('title', 'Settings')

@section('main-content')

<div class="flex flex-col w-full -mt-1">
    <header class="flex items-center h-16 px-4 border-b bg-white">
      <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100">User Settings {{Auth::user()->name}}</h1>
    </header>
    <main class="flex-1 overflow-y-auto p-4 md:p-6">
      <div class="max-w-3xl mx-auto space-y-8">
        <div class="rounded-lg border bg-card text-card-foreground shadow-sm space-y-4" data-v0-t="card">
          <div class="flex flex-col space-y-1.5 p-6">
            <h3 class="text-2xl font-semibold whitespace-nowrap leading-none tracking-tight">Personal Information</h3>
          </div>
          <div class="p-6 space-y-4">
            <div class="space-y-2">
              <label
                class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70"
                for="name"
              >
                Full Name
              </label>
              <input
                class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50"
                id="name"
                name="name"
                value="{{Auth::user()->name}}"
                placeholder="Enter your full name"
              />
            </div>
          </div>
        </div>
        <div class="rounded-lg border bg-card text-card-foreground shadow-sm space-y-4" data-v0-t="card">
          <div class="flex flex-col space-y-1.5 p-6">
            <h3 class="text-2xl font-semibold whitespace-nowrap leading-none tracking-tight">Contact Details</h3>
          </div>
          <div class="p-6 space-y-4">
            <div class="space-y-2">
              <label
                class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70"
                for="email"
              >
                Email Address
              </label>
              <input
                class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50"
                id="email"
                name="email"
                value="{{Auth::user()->email}}"
                placeholder="Enter your email"
                type="email"
              />
            </div>
          </div>
        </div>
        <div class="rounded-lg border bg-card text-card-foreground shadow-sm space-y-4" data-v0-t="card">
          <div class="flex flex-col space-y-1.5 p-6">
            <h3 class="text-2xl font-semibold whitespace-nowrap leading-none tracking-tight">Account Settings</h3>
          </div>
          <div class="p-6 space-y-4">
            <div class="space-y-2">
              <label
                class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70"
                for="password"
              >
                Password
              </label>
              <input
                class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50"
                id="password"
                name="password"    
                value="{{Auth::user()->password}}"
                placeholder="Enter your password"
                type="password"
              />
            </div>
            <?php if ( isset($_GET['edit']) ){ ?>
            <div class="space-y-2">
              <label
                class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70"
                for="confirm-password"
              >
                Confirm Password
              </label>
              <input
                class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50"
                id="confirm-password"
                name="password2" 
                placeholder="Confirm your password"
                type="password"
              />
            </div>
            <?php } ?>
          </div>
        </div>
        <?php if ( isset($_GET['edit']) ){ ?>
        <div class="flex justify-end">
          <button class="inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-black text-gray-100 -foreground hover:bg-primary/90 h-10 px-4 py-2 w-full sm:w-auto">
            Save Changes
          </button>
        </div>
        <?php } else { ?>
        <div class="flex justify-end">
            <button class="inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-black text-gray-100 -foreground hover:bg-primary/90 h-10 px-4 py-2 w-full sm:w-auto">
              Edit
            </button>
          </div>
        <?php } ?>
      </div>
    </main>
  </div>


@endsection
