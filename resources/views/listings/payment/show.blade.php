@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Purchase Listing</div>
                <div class="panel-body">
                    @if($listing->cost() == 0)
                        <form action="{{ route('listings.payment.update', [$area, $listing]) }}" method="post">
                            {{ csrf_field() }}
                            {{ method_field('patch') }}
                            <p>Post listing at no charge</p>
                            <button type="submit" class="btn btn-primary">Post Listing</button>
                        </form>
                    @else
                        <p>Total cost: ${{ $listing->cost() }}</p>
                        <payment-form></payment-form>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
