<?php

namespace App\Http\Controllers;
use App\Reviews;
use App\User;
use Redirect;
use App\Http\Controllers\Controller;
use App\Http\Requests\ReviewFormRequest;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index()
  {
    //fetch 5 posts from database which are active and latest
    $reviews = Reviews::where('active',1)->orderBy('created_at','desc')->paginate(5);
    //page heading
    $title = 'Latest reviews';
    //return home.blade.php template from resources/views folder
    return view('home')->withReviews($reviews)->withTitle($title);
  }
  
  public function create(Request $request)
  {
    // if user can post i.e. user is admin or author
    if($request->user()->can_post())
    {
      return view('reviews.create');
    }    
    else 
    {
      return redirect('/')->withErrors('You do not have sufficient permissions for writing reviews');
    }
  }
  
  public function store(ReviewFormRequest $request)
  {
    $review = new Reviews();
    $review->title = $request->get('title');
    $review->body = $request->get('body');
    $review->slug = str_slug($review->title);
    $review->author_id = $request->user()->id;
    if($request->has('save'))
    {
      $review->active = 0;
      $message = 'Review saved successfully';            
    }            
    else 
    {
      $review->active = 1;
      $message = 'Review published successfully';
    }
    $review->save();
    return redirect('edit/'.$review->slug)->withMessage($message);
  }
  
  public function show($slug)
  {
    $review = Reviews::where('slug',$slug)->first();
    if(!$review)
    {
       return redirect('/')->withErrors('Requested page not found');
    }
    $comments = $review->comments;
    return view('reviews.show')->withReview($review)->withComments($comments);
  }
  
  public function edit(Request $request,$slug)
  {
    $review = Reviews::where('slug',$slug)->first();
    if($review && ($request->user()->id == $review->author_id || $request->user()->is_admin()))
      return view('reviews.edit')->with('review',$review);
    return redirect('/')->withErrors('you do not have sufficient permissions');
  }
  
  public function update(Request $request)
  {
    //
    $review_id = $request->input('review_id');
    $review = Reviews::find($review_id);
    if($review && ($review->author_id == $request->user()->id || $request->user()->is_admin()))
    {
      $title = $request->input('title');
      $slug = str_slug($title);
      $duplicate = Reviews::where('slug',$slug)->first();
//      if($duplicate)
//      {
//        if($duplicate->id != $review_id)
//        {
//          return redirect('edit/'.$review->slug)->withErrors('Title already exists.')->withInput();
//        }
//        else 
//        {
//          $review->slug = $slug;
//        }
//      }
      $review->title = $title;
      $review->body = $request->input('body');
      if($request->has('save'))
      {
        $review->active = 0;
        $message = 'Review saved successfully';
        $landing = 'edit/'.$review->slug;
      }            
      else {
        $review->active = 1;
        $message = 'Review updated successfully';
        $landing = $review->slug;
      }
      $review->save();
           return redirect($landing)->withMessage($message);
    }
    else
    {
      return redirect('/')->withErrors('you have not sufficient permissions');
    }
  }
  
  public function destroy(Request $request, $id)
  {
    //
    $review = Reviews::find($id);
    if($review && ($review->author_id == $request->user()->id || $request->user()->is_admin()))
    {
      $review->delete();
      $data['message'] = 'Post deleted successfully';
    }
    else 
    {
      $data['errors'] = 'Invalid Operation. You have not sufficient permissions';
    }
    return redirect('/')->with($data);
  }
}
