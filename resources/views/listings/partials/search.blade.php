@if(isset($category))
    <listing-search category-id="{{ $category->id }}" :area-ids="{{ 
        $area->descendants->pluck('id')->push($area->id) }}">
        <hr>
    <span class="pull-right">powered by <img src="/images/algolia-logo.jpg"></span>
    </listing-search>
@else
    <listing-search :area-ids="{{ $area->descendants->pluck('id')->push($area->id) }}">
<<<<<<< HEAD
    </listing-search>    
=======
    </listing-search>
>>>>>>> 11472a63da4fb995b120a726ba1ab7d7fba93e28
@endif