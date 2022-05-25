@extends('layouts.app')
@section('content')
    
  <div class="flex justify-center">
    <div class="w-8/12 bg-white p-6 rounded-lg">
        @auth
            <form action="{{ route('tickets') }}" method="post" class="mb-4">
                @csrf
                <div class="mb-4">
                    <label for="title" class="sr-only">Title</label>
                    <input type="text" name="title" class="bg-gray-100 border-2 m-1 w-full p-4 rounded-lg @error('title') border-red-500 @enderror" placeholder="Title">
                    <input type="hidden" name="status" value="new">
                    @error('title')
                        <div class="text-red-500 mb-2 mx-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                    <label for="body"  class="sr-only">Body</label>
                    <textarea name="body" id="body" cols="30" rows="4" class=" m-1 bg-gray-100 border-2 w-full p-4 rounded-lg @error('body') border-red-500 @enderror" placeholder="Content!"></textarea>
                    @error('body')
                        <div class="text-red-500 mb-2 mx-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                    <select name="service_id" id="service" class="bg-gray-100 border-2 m-1 w-full p-4 rounded-lg @error('service') border-red-500 @enderror" placeholder="Service" >
                        <option value="" disabled selected>--Service--</option>
                        @foreach ($services as $service)
                            <option value="{{ $service->id }}">{{ $service->name }}</option>
                        @endforeach
                    </select>
                    @error('service')
                        <div class="text-red-500 mb-2 mx-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded font-medium">Post</button>
                </div>
            </form>
        @endauth

        {{-- @if ($posts->count())
            @foreach ($posts as $post)
                <x-post :post="$post" />
            @endforeach

            {{ $posts->links() }}
        @else 
            <p>There are no posts</p>
        @endif --}}
    </div>
</div>

{{-- comments --}}
<div class="flex flex-col w-full">
    @if ($tickets->count())
    <div class="flex flex-col justify-center items-center">
        @foreach ($tickets as $ticket)
            
        <div class="bg-white w-full sm:w-8/12 rounded-md shadow-md h-auto py-3 px-3 my-3">
            <div class="w-full h-16 flex items-center flex justify-between ">
                <div class="flex">
                    <div>    
                        <h3 class="text-md font-semibold "> TITLE: {{$ticket->title}} </h3>
                        <p class="text-xs text-gray-500">{{ $ticket->created_at->diffForHumans() }}</p>
                    </div>
                </div>

                
                <div class="flex">
                    <form action="" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-none">
                            <svg class="h-6 w-6 text-red-500"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                        </button>
                    </form>
                    <a href=" {{route('tickets.details', $ticket)}} " title="show more">
                        <svg class="h-6 w-6 text-black"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />  <circle cx="12" cy="12" r="3" />
                        </svg>
                    </a>
                </div> 
                
            </div>
            <p>
                {{$ticket->body}}
            </p>
            
        </div>
        @endforeach
    </div>
    @else
        <div class="flex justify-center mt-3 ">
            <div class="w-8/12 bg-white p-6 rounded-lg font-bold">
                There are no tickets
            </div>
        </div>
    @endif
</div>
@endsection