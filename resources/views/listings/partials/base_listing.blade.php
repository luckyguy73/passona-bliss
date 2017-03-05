<div class="media">
    <div class="media-body">
        <h5><strong><a href="{{ route('listings.show', [$area, $listing]) }}">{{ $listing->title }}</a></strong></h5>
        
        <ul class="list-inline">
            @if($area->children->count())
                <li>
                    @if(empty($listing->area->parent))
                        {{ $listing->area->name }}
                    @else
                        {{ $listing->area->name }}, {{ $listing->area->parent->name }}
                    @endif
                </li>
            @endif
            <li>
                <time>Created: {{ $listing->created_at->diffForHumans() }}</time>
            </li>
            <li>
                By: {{ $listing->user->full_name }}
            </li>
        </ul>
        
        {{ $links or '' }}
    </div>
</div>

