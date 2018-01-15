<?php

namespace App\Http\Controllers;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Reviews;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /*
   * Display active reviews of a particular user
   * 
   * @param int $id
   * @return view
   */
  public function user_reviews($id)
  {
    //
    $reviews = Reviews::where('author_id',$id)->where('active',1)->orderBy('created_at','desc')->paginate(5);
    $title = User::find($id)->name;
    return view('home')->withReviews($reviews)->withTitle($title);
  }
  /*
   * Display all of the reviews of a particular user
   * 
   * @param Request $request
   * @return view
   */
  public function user_reviews_all(Request $request)
  {
    //
    $user = $request->user();
    $reviews = Reviews::where('author_id',$user->id)->orderBy('created_at','desc')->paginate(5);
    $title = $user->name;
    return view('home')->withReviews($reviews)->withTitle($title);
  }
  /*
   * Display draft reviews of a currently active user
   * 
   * @param Request $request
   * @return view
   */
  public function user_reviews_draft(Request $request)
  {
    //
    $user = $request->user();
    $reviews = Reviews::where('author_id',$user->id)->where('active',0)->orderBy('created_at','desc')->paginate(5);
    $title = $user->name;
    return view('home')->withReviews($reviews)->withTitle($title);
  }
  /**
   * profile for user
   */
  public function profile(Request $request, $id) 
  {
    $data['user'] = User::find($id);
    if (!$data['user'])
      return redirect('/');
    if ($request -> user() && $data['user'] -> id == $request -> user() -> id) {
      $data['author'] = true;
    } else {
      $data['author'] = null;
    }
    $data['comments_count'] = $data['user'] -> comments -> count();
    $data['reviews_count'] = $data['user'] -> reviews -> count();
    $data['reviews_active_count'] = $data['user'] -> reviews -> where('active', '1') -> count();
    $data['reviews_draft_count'] = $data['reviews_count'] - $data['reviews_active_count'];
    $data['latest_reviews'] = $data['user'] -> reviews -> where('active', '1') -> take(5);
    $data['latest_comments'] = $data['user'] -> comments -> take(5);
    return view('admin.profile', $data);
  }
}
