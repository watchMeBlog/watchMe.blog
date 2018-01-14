@extends('app')
@section('title')
{{ $user->name }}
@endsection
@section('content')
<div>
  <ul class="list-group">
    <li class="list-group-item">
      Joined on {{$user->created_at->format('M d,Y \a\t h:i a') }}
    </li>
    <li class="list-group-item panel-body">
      <table class="table-padding">
        <style>
          .table-padding td{
            padding: 3px 8px;
          }
        </style>
        <tr>
          <td>Total reviews</td>
          <td> {{$reviews_count}}</td>
          @if($author && $reviews_count)
          <td><a href="{{ url('/my-all-reviews')}}">Show All</a></td>
          @endif
        </tr>
        <tr>
          <td>Published reviews</td>
          <td>{{$reviews_active_count}}</td>
          @if($reviews_active_count)
          <td><a href="{{ url('/user/'.$user->id.'/reviews')}}">Show All</a></td>
          @endif
        </tr>
        <tr>
          <td>reviews in Draft </td>
          <td>{{$reviews_draft_count}}</td>
          @if($author && $reviews_draft_count)
          <td><a href="{{ url('my-drafts')}}">Show All</a></td>
          @endif
        </tr>
      </table>
    </li>
    <li class="list-group-item">
      Total Comments {{$comments_count}}
    </li>
  </ul>
</div>
<div class="panel panel-default">
  <div class="panel-heading"><h3>Latest reviews</h3></div>
  <div class="panel-body">
    @if(!empty($latest_reviews[0]))
    @foreach($latest_reviews as $latest_review)
      <p>
        <strong><a href="{{ url('/'.$latest_review->slug) }}">{{ $latest_review->title }}</a></strong>
        <span class="well-sm">On {{ $latest_review->created_at->format('M d,Y \a\t h:i a') }}</span>
      </p>
    @endforeach
    @else
    <p>You have not written any review till now.</p>
    @endif
  </div>
</div>
<div class="panel panel-default">
  <div class="panel-heading"><h3>Latest Comments</h3></div>
  <div class="list-group">
    @if(!empty($latest_comments[0]))
    @foreach($latest_comments as $latest_comment)
      <div class="list-group-item">
        <p>{{ $latest_comment->body }}</p>
        <p>On {{ $latest_comment->created_at->format('M d,Y \a\t h:i a') }}</p>
        <p>On review <a href="{{ url('/'.$latest_comment->review->slug) }}">{{ $latest_comment->review->title }}</a></p>
      </div>
    @endforeach
    @else
    <div class="list-group-item">
      <p>You have not commented till now. Your latest 5 comments will be displayed here</p>
    </div>
    @endif
  </div>
</div>
@endsection