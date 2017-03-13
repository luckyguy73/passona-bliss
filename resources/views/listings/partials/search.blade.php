@if(isset($category))
    <listing-search category-id="{{ $category->id }}" :area-ids="{{ 
        $area->descendants->pluck('id')->push($area->id) }}">
        <hr>
    <span class="pull-right">powered by <img src="/images/algolia-logo.jpg"></span>
    </listing-search>
@else
    <listing-search :area-ids="{{ $area->descendants->pluck('id')->push($area->id) }}">
    </listing-search>
@endif