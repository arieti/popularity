<?php

namespace App\Http\Controllers;

use App\Channel;
use App\CommunityLink;
use Illuminate\Http\Request;

class CommunityLinksController extends Controller
{
    public function index()
    {
    	$links = CommunityLink::paginate(25);
    	$channels = Channel::orderBy('title', 'asc')->get();
    	return view('community.index', compact('links', 'channels'));
    }

    public function store(Request $request)
    {
    	$this->validate($request, [
    		'channel_id' => 'required|exists:channels,id',
    		'title' => 'required',
    		'link'  => 'required|unique:community_links'
    	]);

    	CommunityLink::from(auth()->user())
    		->contribute($request->all());

    	return back();
    }
}
