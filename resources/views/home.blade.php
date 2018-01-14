@extends('app')

@section('title')
{{$title}}
@endsection

@section('content')

@if ( !$reviews->count() )
There is no post till now. Login and write a new post now!!!
@else
<div class="">
	@foreach( $reviews as $review )
	<div class="list-group">
		<div class="list-group-item">
			<h3><a href="{{ url('/'.$review->slug) }}">{{ $review->title }}</a>
				@if(!Auth::guest() && ($review->author_id == Auth::user()->id || Auth::user()->is_admin()))
					@if($review->active == '1')
					<button class="btn" style="float: right"><a href="{{ url('edit/'.$review->slug)}}">Edit review</a></button>
					@else
					<button class="btn" style="float: right"><a href="{{ url('edit/'.$review->slug)}}">Edit draft</a></button>
					@endif
				@endif
			</h3>
			<p>{{ $review->created_at->format('M d,Y \a\t h:i a') }} By <a href="{{ url('/user/'.$review->author_id)}}">{{ $review->author->name }}</a></p>
			
		</div>
		<div class="list-group-item">
			<article>
				{!! str_limit($review->body, $limit = 1500, $end = '....... <a href='.url("/".$review->slug).'>Read More</a>') !!}
			</article>
		</div>
	</div>
	@endforeach
	{!! $reviews->render() !!}
</div>
@endif

@endsection
