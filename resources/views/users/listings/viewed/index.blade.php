@extends('layouts.app')

@section('content')
    <p>The last {{ $indexLimit }} viewed listings</p>
    @if($listings->count())
        @foreach($listings as $listing)
            @include('listings.partials.listing', compact('listing'))
        @endforeach
    @else
        <p>No viewed listings found</p>
    @endif
@endsection