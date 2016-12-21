<?php

namespace App\Http\Controllers;

use App\Channel;
use App\CommunityLink;
use Illuminate\Http\Request;
use App\Http\Requests\CommunityLinkForm;
use App\Queries\CommunityLinksQuery;
use App\Exceptions\CommunityLinkAlreadySubmitted;

class CommunityLinksController extends Controller
{
    public function index(Channel $channel = null)
    {
    	$links = (new CommunityLinksQuery)->get($channel);

    	$channels = Channel::orderBy('title', 'asc')->get();
    	return view('community.index', compact('links', 'channels', 'channel'));
    }

    public function store(CommunityLinkForm $form)
    {
        try {
            $form->persist();

            if(auth()->user()->isTrusted()){
                flash('Thanks for the contribution', 'success');
            } else {
                flash()->overlay('This contribution will be approved shortly', 'Thanks!');
            }
        } catch(CommunityLinkAlreadySubmitted $e) {
            flash()->overlay(
                "We'll instead bump the timestamps and bring that link back to the top.",
                "That link has already been submitted"
            );
        }

    	return back();
    }
}
