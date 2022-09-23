<?php

namespace App\Http\Controllers\Admin;

use App\Admin\Post;
use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::all();

        // ? Sql query per prendere tutti i post id presenti in un distinto tag
        // SELECT COUNT(DISTINCT post_id)
        // FROM `post_tag`
        // GROUP BY tag_id
        // ! Prende con count i distinti post all'interno di tag, potenza estrema
        // $dist = Tag::withCount('posts')->get();
        // dd($dist);
        // FIXME $dist = DB::table('users')->distinct()->get()
        // $dist = DB::table('post_tag')->count('post_id')->groupBy('tag_id')->get();


        // $tagz = Tag::all()

        return view('admin.tags.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tag = new Tag();
        return view('admin.tags.create', compact('tag'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newData = $request->all();
        $validateData = $request->validate(
            [
                'name' => 'required|min:3|max:20|unique:tags',
            ],
            [
                'name.exists' => 'This is arleady taken.',
                'name.unique' => 'This tag already exists.',
            ]
        );
        $newTag = new Tag();

        $newTag->create($newData);

        return redirect()->route('admin.tags.index')->with('status-change', $newData['name'] . ' ' . 'è stata aggiunta con successo!')
        ->with(['class' => 'alert-success']);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Tag $tag)
    {
        $posts = $tag->posts;
        // dd($posts);
        return view('admin.tags.show', compact('tag', 'posts'));
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
    public function destroy(Tag $tag)
    {
        $tag->delete();
        return redirect()->route('admin.tags.index')->with('status-change', $tag->name  . ' ' . 'è stata eliminata con successo')->with(['class' => 'alert-danger']);
    }
}
