<?php

namespace App\Http\Controllers\Api;

use App\Admin\Post;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();

        return response()->json([
            "success" => true,
            "count" => count($posts),
            "data" => $posts,
        ]);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // ! Per il singolo post nella show, usiamo find per trovarlo
        // $post = Post::find($id);
        // // ! Se è stato trovato, manda il dato, altrimenti 404. E' findOrFail ma manuale per poter dare la 404.
        // // ! Con find or fail funzionerebbe allo stesso modo, ma restituisce l'intera pagina di 404, rallentando il tutto
        // if($post){
        //     return response()->json([
        //         "success" => true,
        //         "data" => $post,
        //     ]);
        // }else{
        //     return response('', 404);
        // }

        // ! Esempio con find or fail dove restituisce l'intero blade
        $post = Post::findOrFail($id);

        return response()->json([
            "success" => true,
            "data" => $post,
        ]);
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
}
