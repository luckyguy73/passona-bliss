Hi {{ $listing->user->first_name }}, <br><br>

{{ $sender->full_name }} has contacted you about your listing, <a href="{{ route('listings.show',
[$listing->area, $listing]) }}">"{{ $listing->title }}"</a>.<br><br>

<hr>
<strong>Message:</strong>
<br>
<br>
{!! nl2br(e($body)) !!}
<br>
<br>
<hr>
<br>
Reply to this email to respond directly to the sender.
