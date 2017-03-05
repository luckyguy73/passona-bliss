@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <h4 class="panel-heading">Share Listing - "{{ $listing->title }}"</h4>
                <div class="panel-body">
                    <p>Share this listing with up to 5 of your friends</p>
                    
                    <form action="{{ route('listings.share.store', [$area, $listing]) }}"
                          method="post">
                        {{ csrf_field() }}
                        @foreach(range(0,4) as $n)
                            <div class="form-group{{ $errors->has('emails.' . $n) ? ' has-error' : '' }}">
                                <input type="text" name="emails[]" id="emails.{{ $n }}" value="{{ old('emails.' . $n) }}"
                                       class="form-control" placeholder="name@email.com">
                                @if($errors->has('emails.' . $n))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('emails.' . $n) }}</strong>
                                    </span>
                                @endif
                            </div>
                        @endforeach
                        
                        <div class="form-group{{ $errors->has('message') ? ' has-error' : '' }}">
                            <label for="message">Message (optional)</label>
                            <textarea name="message" id="message" cols="30" rows="5" class="form-control">
                                {{ old('message') }}</textarea>
                            @if($errors->has('message'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('message') }}</strong>
                                </span>
                            @endif
                        </div>
                        
                        <div class="form-group">
                            <button type="submit" class="btn btn-default">Send</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
