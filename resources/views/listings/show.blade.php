@extends('layouts.app')

@section('content')
    <div class='row'>
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="nav nav-stacked">
                        <li><a href="{{ route('listings.share.index', [$area, $listing]) }}">Email to a friend</a></li>
                        @if(Auth::check())
                            @if(!$listing->favoritedBy(Auth::user()))
                                <li><a href="#" onclick="event.preventDefault(); 
                                    document.getElementById('listing-favorite-form').submit();">Add to favorites</a>
                                    <form action="{{ route('listings.favorites.store', [$area, $listing]) }}"
                                          method="post" class="hidden" id="listing-favorite-form">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>
                        {{ $listing->title }} <span class="text-muted">in {{ $listing->area->name }}</span>
                    </h4>
                </div>
                <div class="panel-body">
                    {!! nl2br(e($listing->body)) !!}
                </div>
                <div class="panel-footer">
                    <p>Viewed {{ $listing->views() }} times</p>
                </div>
            </div>

            <div class="panel panel-default">
                @if(Auth::guest())
                    <div class="panel-heading">
                        <p><a href="{{ route('register') }}">Register</a> for an account or 
                            <a href="{{ route('login') }}">Login</a> to contact listing owner.</p>
                    </div>
                @else
                    <div class="panel-heading">
                        <h4>Contact {{ $listing->user->full_name }}</h4>
                    </div>
                    <div class="panel-body">

                            <form action="{{ route('listings.contact.store', [$area, $listing]) }}" method="POST">
                                {{ csrf_field() }}
                                <div class="form-group{{ $errors->has('message') ? ' has-error' : '' }}">
                                    <label for="message" class="control-label">Message</label>
                                    <textarea name="message" id="message" cols="30" rows="5" 
                                              class="form-control">{{ old('message') }}</textarea>
                                    @if(count($errors))
                                        <div class='alert alert-danger'>
                                            <ul>
                                                @foreach($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-default">Send</button>
                                    <span class="help-block">This will email {{ $listing->user->full_name }}
                                        and they will be able to reply directly to you by email.</span>
                                </div>
                            </form>
                    </div>
                @endif
            </div>

        </div>
    </div>
@endsection
