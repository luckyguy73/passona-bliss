@extends('layouts.app')

@section('content')
    @if($listings->count())
        @foreach($listings as $listing)
            @include('listings.partials.listing_own', compact('listing'))
        @endforeach

        {{ $listings->links() }}
    @else
        <p>No published listings found</p>
    @endif
@endsection