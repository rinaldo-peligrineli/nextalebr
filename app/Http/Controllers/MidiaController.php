<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Models\Story;
use App\Models\Midia;

class MidiaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            $file = $request->file('file');
            $user_id = $request->get('user_id');
            $story_id = $request->get('story_id');

            $request->validate([
                'file' => 'required|mimes:png,jpg,pdf,jpeg,m4v,avi,flv,mp3,wma,aac,mp4,mov|max:5120'
            ]);
           
            $dirPath = public_path() . '/assets/midias/' . $story_id;
            $filePath = $dirPath . "/{$file->getClientOriginalName()}";
            $linkPath = "/assets/midias/{$story_id}/{$file->hashName()}" ;

            if (!is_dir($dirPath)) {
                mkdir($dirPath, 0777, true);
            } 

            $file->store($story_id, ['disk' => 'my_files']);

            $arrMidia = array(
                'url_midia' => $linkPath,
                'is_enabled' => '1'
            );

            $story = Story::find($story_id);
            $user = Story::find($user_id );

            $midia = new Midia();
            $midia->fill($arrMidia);
            $midia->story()->associate($story);
            $midia->user()->associate($user);
            $midia->save();   
          
            return response()->json(['success' => 'Midia Created', $midia], 200);
        } catch(\Exception $e)  {
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
        //
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
    public function destroy($id)
    {
        //
    }

    /**
     * Display the all midias by user.
     *
     * @param  int  $story_id
     * @return \Illuminate\Http\Response
     */
    public function getAllMidiasByStory($story_id) {
        try {
            $midias = Midia::where('story_id', $story_id)->get();
            return response()->json(['success' => 'Midias found', $midias], 200);
        } catch(\Exception $e) {
            return response()->json(['error' => $e->getMessage()], '404');
        }   
    }

     /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyByUser(Request $request)
    {
        try {
            $user_id = $request->get('user_id');
            $midias = Midia::where('user_id', $user_id)->delete();
           
            return response()->json(['success' => 'Midias deleted'], 200);
        } catch(\Exception $e) {
            return response()->json(['error' => $e->getMessage()], '404');
        }   
    }
}
