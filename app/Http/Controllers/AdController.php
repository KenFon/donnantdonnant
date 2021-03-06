<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ad;
use App\Models\Category;
use App\Models\User;

class AdController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = Category::with('ads.user')->where('id', $request->cat)->first();
        $ads = $categories->ads->where('type', $request->type)->sortByDesc('ad.created_at');
        return response()->json($ads);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($type=NULL)
    {
        return view('annonces.create', compact('type'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Ads $ad)
    {
        return view('annonces.show', compact('ad'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Ads::where('id', $request->id)->delete();
    }


    public function search(Request $request)
    {
        $categories = Category::with('ads.user')->where('id', $request->cat)->first();
        $ads = $categories->ads->where('type', 'search')->sortByDesc('ad.created_at')->take(4);
        return response()->json($ads);
    }

    public function offer(Request $request)
    {
        $categories = Category::with('ads.user')->where('id', $request->cat)->first();
        $ads = $categories->ads->where('type', 'offer')->sortByDesc('ad.created_at')->take(4);
        return response()->json($ads);
    }

    /** Fonction de debug ajax */
    public function deb(Request $request)
    {

    }
}
