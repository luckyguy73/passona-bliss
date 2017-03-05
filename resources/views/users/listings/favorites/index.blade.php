@extends('layouts.app')

@section('content')
    @if($listings->count())
        @foreach($listings as $listing)
            @include('listings.partials.listing_favorite', compact('listing'))
        @endforeach

        {{ $listings->links() }}
    @else
        <p>No favorite listings found</p>
    @endif
@endsection