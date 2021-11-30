<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Story;

class StoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $story = Story::orderBy('created_at', 'desc')->get();
            return response()->json(['success' => 'Stories founds', $story], 200);
        } catch(\Exception $e) {
            return response()->json(['error' => $e->getMessage()], '404');
        }   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        try {
            

            $title = $request->get('title');
            $body = $request->get('body');
            $is_enabled = $request->get('is_enabled');

            $arrStory = array(
                'title' => $title,
                'body' => $body,
                'is_enabled' => $is_enabled
            );
            $stories = Story::create($arrStory);
            
            return response()->json(['success' => 'success', $stories], 200);
            
        } catch(\Exception $e) {
            return response()->json(['error' => $e->getMessage()], '404');
        }   
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       
    }

    public function getByStoryId(Request $request)
    {
        try {
            $id = $request->get('story_id');
            $story = Story::findOrFail($id);
            return response()->json(['success' => 'Story found', $story], 200);
        } catch(\Exception $e) {
            return response()->json(['error' => $e->getMessage()], '404');
        }   
    }
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $story = Story::findOrFail($id);
            return response()->json(['success' => 'Story added', $story], 200);
        } catch(\Exception $e) {
            return response()->json(['error' => $e->getMessage()], '404');
        }   
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
    public function destroy($id)
    {
        try {
            $story = Story::findOrFail($id)->delete();
            return response()->json(['success' => 'Story deleted', $story], 200);
        } catch(\Exception $e) {
            return response()->json(['error' => $e->getMessage()], '404');
        }   
    }
}
