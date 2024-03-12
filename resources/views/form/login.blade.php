<div class="w-full md:w-2/4 lg:w-2/3 xl:w-2/4 place-content-center mx-auto min-w-fit mt-40 transition-all duration-500 ease-in-out">
  <div class="w-full bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md transition-all duration-500 ease-in-out">
      <form action="{{ url('/login') }}" method="post" class="grid gap-8 w-full transition-all duration-500 ease-in-out">
          @csrf
          @error('admin')
              <span class="text-red-500 peer-disabled:cursor-not-allowed peer-disabled:opacity-70 text-lg font-semibold transition-all duration-500 ease-in-out">{{ $message }}</span>
          @enderror
          <div class="space-y-2">
              <label class="peer-disabled:cursor-not-allowed peer-disabled:opacity-70 text-lg font-semibold transition-all duration-500 ease-in-out" for="email">
                  Email
                  @error('email')
                      <span class="text-red-500">{{ $message }}</span>
                  @enderror
              </label>
              <input
                  class="flex h-10 w-full border-input bg-background text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 border rounded-lg p-2 transition-all duration-500 ease-in-out"
                  id="email"
                  name="email"
                  placeholder="john@example.com"
                  type="email"
              />
          </div>
          <div class="space-y-2">
              <label
                  class="peer-disabled:cursor-not-allowed peer-disabled:opacity-70 text-lg font-semibold transition-all duration-500 ease-in-out"
                  for="password"
              >
                  Password
                  @error('password')
                      <span class="text-red-500">{{ $message }}</span>
                  @enderror
              </label>
              <input
                  class="flex h-10 w-full border-input bg-background text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 border rounded-lg p-2 transition-all duration-500 ease-in-out"
                  id="password"
                  name="password"
                  type="password"
              />
          </div>
          <input type="submit" value="Sign in" class="inline-flex items-center justify-center whitespace-nowrap text-sm ring-offset-background focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 h-10 w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition-all duration-500 ease-in-out"/>
          <button class="justify-center whitespace-nowrap text-sm ring-offset-background focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 h-10 w-full bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center transition-all duration-500 ease-in-out">
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
                  class="w-4 h-4 mr-2 transition-all duration-500 ease-in-out"
              >
                  <circle cx="12" cy="12" r="10"></circle>
                  <circle cx="12" cy="12" r="4"></circle>
                  <line x1="21.17" x2="12" y1="8" y2="8"></line>
                  <line x1="3.95" x2="8.54" y1="6.06" y2="14"></line>
                  <line x1="10.88" x2="15.46" y1="21.94" y2="14"></line>
              </svg>
              Sign in with Google
          </button>
      </form>
  </div>
</div>
