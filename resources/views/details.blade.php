@extends('layouts.app')
@section('content')


<div class="bg-white w-full sm:w-8/12 rounded-md mx-auto shadow-md h-auto py-3 px-3 my-3">
    @if( $ticket->status !== 'Resolved')
    <div class="flex justify-end ">
        <form action="{{ route('tickets.update', $ticket) }}" method="POST">

            @csrf
            @method('PUT')
            <button
                type="submit"
                class="underline"
            >
                Resolved
            </button>
        </form>
    </div>
    @endif
    <div class="w-full h-16 flex items-center flex justify-between ">
        <div class="flex">
            <div>    
                <div class="flex items-center">
                    <h3 class="text-md font-semibold "> {{$ticket->title}} &nbsp&nbsp </h3> 
                    @switch($ticket->status)
                        @case("Resolved")
                            <p class="border rounded-md px-3 py-1 ml-4 bg-green-500 text-white font-bold">{{$ticket->status}}</p>
                            @break
                        @case("Answerd")
                            <p class="border rounded-md px-3 py-1 ml-4 bg-blue-500 text-white font-bold">{{$ticket->status}}</p>
                            @break
                        @case("new")
                            <p class="border rounded-md px-3 py-1 ml-4 bg-yellow-500 text-white font-bold">{{$ticket->status}}</p>
                            @break
                    @endswitch
                
                </div>
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
        </div> 
        
    </div>
    <p>
        {{$ticket->body}}
    </p>
    
    <div class="mt-3">
        @foreach ($ticket->responces as $responce)
            <div class="flex flex-col items-start justify-start my-1 mx-4">
                     <div class="text-xs my-3 font-bold">
                        <span>{{$responce->user->name}}</span>
                    </div>
                    <div class="bg-gray-100 rounded-full px-10 py-3 mb-2">
                        <span class="text-sm w-auto"> {{$responce->body}} </span>
                    </div>
                    <span class="flex justify-start items-center">
                        <span class="text-xs text-gray-700 px-2 justify-center">
                            {{ $responce->created_at->diffForHumans() }}
                        </span>
                        @can('delete')
                            <form action="{{ route('comments.destroy') }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="">
                                    <span class="text-xs text-gray-700 px-2 justify-center underline">
                                        delete
                                    </span>
                                </button>
                            </form>
                        @endcan
                    </span>
            </div>
        @endforeach
    </div>
    @if ($ticket->status!='Resolved')
    
        <form action=" {{route('responce')}} " method="post">
            @csrf
            <div class="flex justify-center w-full items-center">
                <input name="body" type="text" class="mt-4 border border-grey w-full border-1 rounded-full p-2 relative focus:border-red pl-8 text-grey-dark font-light w-full text-sm font-medium tracking-wide rounded-full bg-gray-100" placeholder="Type your responce..." />
                <button class="rounded-full bg-indigo-500 ml-3 px-4 py-2 text-white mt-4 w-auto" name="ticket_id" value="{{$ticket->id}}">Responce</button>
            </div>
            @error('body')
                <div class="text-red-500 mb-3 text-sm">
                    {{ $message }}
                </div>
            @enderror
        </form>
        
    @endif
    
</div>




@endsection