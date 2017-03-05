<div class="media">
    <div class="media-body">
        <h5>
            <strong>
                @if($listing->live())
                    <a href="{{ route('listings.show', [$area, $listing]) }}">{{ $listing->title }}</a>
                @else
                    {{ $listing->title }}
                @endif
            </strong>
            in {{ $listing->area->name }}, {{ $listing->area->parent->name }}
        </h5>
        <ul class="list-inline">
            <li>
                <time>{{ $listing->created_at->diffForHumans() }}</time>
            </li>
            <li>
                <time>Last updated {{ $listing->updated_at->diffForHumans() }}</time>
            </li>
        </ul>
        <ul class="list-inline">
            <li>
                <a href="#" onclick="event.preventDefault(); document.getElementById('delete-listing-{{ $listing->id }}').submit();">Remove</a>
            </li>
            <li><a href="{{ route('listings.edit', [$area, $listing]) }}">Edit</a></li>
        </ul>
    </div>
</div>

<form action="{{ route('listings.destroy', [$area, $listing]) }}" method="post" id="delete-listing-{{ $listing->id }}">
    {{ csrf_field() }}
    {{ method_field('delete') }}
</form>