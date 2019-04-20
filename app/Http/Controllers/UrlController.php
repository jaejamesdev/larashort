<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Url;

class UrlController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth'); //Makes sure a user is logged in
    }

    /**
     * Store a URL against a user in the Urls table.
     *
     * @return redirect
     */
    public function store(Request $request) {
        if(!isset($request->url)) { //Check if the request contains the URL that we need to shorten (can be swapped for Laravel's Validator)
            return redirect()->back()->with('error','You Need To Enter A Url'); //If it doesn't, lets go back and ask the user
        }
        Url::create(['user_id' => Auth::user()->id, 'url' => $request->url]); //If it does, let's create that Url against the User ID
        return redirect()->back()->with('success','URL Shorterned'); //Then lets go back to the user saying that has been successful
    }

    public function showUrl(Url $url) {
        if(!$url) { //If that shorterned URL doesn't exist, redirect to the homepage
            return redirect('/');
        }
        return redirect($url->url); //If that url does exist, redirect the person to the stored URL
    }
}
