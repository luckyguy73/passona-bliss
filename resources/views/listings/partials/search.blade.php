@if(isset($category))
    <listing-search category-id="{{ $category->id }}" :area-ids="{{ 
        $area->descendants->pluck('id')->push($area->id) }}">
    </listing-search>
@else
    <listing-search :area-ids="{{ $area->descendants->pluck('id')->push($area->id) }}">
    </listing-search>
    <hr>
    <span class="pull-right">powered by <img src="/public/images/algolia-logo.jpg"></span>
@endif