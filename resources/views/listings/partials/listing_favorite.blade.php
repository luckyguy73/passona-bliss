@component('listings.partials.base_listing', compact('listing'))
    @slot('links')
        <ul class="list-inline">
            <li>Favorite added:  {{ $listing->pivot->created_at->diffForHumans() }}</li>
            <li><a href="#" onclick="event.preventDefault(); document.getElementById('listings-favorites-destroy-{{ $listing->id }}').submit();">Delete</a></li>
            <form action="{{ route('listings.favorites.destroy', [$area, $listing]) }}"
                  method="post" id="listings-favorites-destroy-{{ $listing->id }}">
                {{ csrf_field() }}
                {{ method_field('delete') }}
            </form>
        </ul>
    @endslot
@endcomponent