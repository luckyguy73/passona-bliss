@extends('layouts.app')

@section('content')
    @include('listings.partials.search', [
        'category' => $category
    ])
    <h4>{{ $category->parent->name }} > {{ $category->name }}</h4>

    @if($listings->count())
        @foreach($listings as $listing)
            @include('listings.partials.listing', compact('listing'))
        @endforeach

        {{ $listings->links() }}
    @else
        <p>No listings found</p>
    @endif
@endsection
