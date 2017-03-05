@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <h4 class="panel-heading">
                    Edit Listing
                    @if($listing->live())
                        <span class="pull-right">
                            <a href="{{ route('listings.show', [$area, $listing]) }}">
                                Go to listing</a>
                        </span>
                    @endif
                </h4>
                <div class="panel-body">
                    <form action="{{ route('listings.update', [$area, $listing]) }}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('patch') }}
                        @include('listings.partials.forms.areas')
                        @include('listings.partials.forms.categories')
                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="title" class="control-label">Title</label>
                            <input type="text" class="form-control" name="title" 
                                   id="title" value="{{ $listing->title }}">
                            @if ($errors->has('title'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('body') ? ' has-error' : '' }}">
                            <label for="body" class="control-label">Body</label>
                            <textarea name="body" id="body" cols="30" rows="8" 
                                      class="form-control">{{ $listing->body }}</textarea>
                            @if ($errors->has('body'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('body') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group clearfix">
                            <button type="submit" class="btn btn-default">Save</button>
                            
                        @if(!$listing->live())
                            <button type="submit" class="btn btn-primary pull-right"
                                    name="payment" value="true">Purchase Listing</button>
                        @endif
                        </div>
                        
                        
                        @if($listing->live())
                            <input type="hidden" name="category_id" value="{{ $listing->category_id }}">
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
