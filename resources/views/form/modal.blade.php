@if (isset($_GET['data']) && !empty($_GET['data']))
    @php
        $decodedData = json_decode(base64_decode($_GET['data']), true);
    @endphp
    <div class="fixed bg-white top-1/4 z-20 rounded-lg border bg-card text-card-foreground shadow-sm">
        <div class="p-6 flex flex-row justify-between w-full items-center space-y-1">
            <h3 class="text-2xl font-semibold whitespace-nowrap leading-none tracking-tight">Update user</h3>
            <a href="{{url('users')}}" class="text-gray-500 cursor-pointer font-bold hover:text-gray-800 transition-all p-1">
                X
            </a>
        </div>
        <form method="POST" action="{{url("users/update/{$decodedData['id']}")}}" class="p-6 space-y-4">
            @csrf
            @foreach ($decodedData as $key => $data)
                @if ( $key === 'id' || $key === 'updated_at')
                    <input type="hidden" name="{{$key}}" value="{{$data}}">
                    @continue
                @endif
                <div class="flex items-center space-x-4">
                    <label class="text-sm capitalize font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70 w-20" for="{{$key}}">
                        @if ($key === 'created_at' || $key == 'registration_date' || $key === 'updated_at')
                        Registration
                        @else
                        {{$key}}
                        @endif
                    </label>
                    @if ($key === 'created_at' || $key == 'registration_date')
                        @php 
                            $dateString = $data;
                            $formattedDate = trim(date('Y-m-d', strtotime(str_replace(array('of','in'),array('',''), $dateString))));
                        @endphp
                        <input type="date" class="flex outline-none h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50"
                            id="{{$key}}" name="{{$key}}" value="{{$formattedDate}}" placeholder="Enter store">
                    @else
                        <input type="text" class="flex outline-none h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50"
                        id="{{$key}}" name="{{$key}}" value="{{$data}}" placeholder="Enter store">
                    @endif
                </div>
            @endforeach
            <div class="flex flex-row w-full justify-around gap-4 p-1">
                <input type="submit" class="cursor-pointer w-full p-2 px-1 bg-gray-800 hover:bg-gray-600 rounded-md text-gray-100" value="Save">
                <input type="button" class="cursor-pointer w-full p-2 px-1 bg-gray-800 hover:bg-gray-600 rounded-md text-gray-100" onclick="window.location.href='{{url('users')}}'" value="Close">
            </div>
        </form>
    </div>
@endif
