<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Events\AdminVoteEvent;
use Illuminate\Support\Facades\Auth;

class VoteController extends Controller
{
    /**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
	    $this->middleware('auth');
    }

    public function adminCounter($id){
        return view('vote.adminvote',compact('id'));
    }
    public function vote($id){
        return view('vote.vote',compact('id'));
    }

    public function startVote(request $request)
    {
    	$user = User::find(Auth::id());
    	event(new AdminVoteEvent($request->counter,$request->status,$user));
    }
}
