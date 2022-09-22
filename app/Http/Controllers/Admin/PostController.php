<?php

namespace App\Http\Controllers\Admin;

use App\Admin\Post;
use App\User;
use App\Http\Controllers\Controller;
use App\Models\Tag;
use DateTime;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $posts = Post::all(); // ! in questo modo vedremmo tutti i post, ma vogliamo visualizzare solo i post del singolo user a cui appartengono

        // $posts = Post::where('user_id', Auth::id())->get(); // ! Ci sono più modi per ottenere i post relativi ad un solo utente

        // ! Sfruttiamo la relazione
        // $user = User::findOrFail(Auth::id());
        // $posts = $user->posts;

        // ! con questo metodo sfruttiamo il model 
        $posts = Auth::user()->posts;
        // dd(Auth::user()->id);

        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::all();

        return view('admin.posts.create', compact('tags'));
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
                'title' => 'required|min:2|max:100',
                'post_image' => 'required|active_url|max:21844',
                'post_content' => 'required|min:10|max:21844',
            ],
            [
                'post_image.active_url' => 'The image must be an active_url',
            ],
        );

        $newPost = new Post();

        // ? Questo permette di usare il nome dell'utente autenticato come nome per la creazione dei propri post
        $newData['user_id'] = Auth::user()->id;

        // ? aggiorno lo slug, la confizione è necessaria se non ci sono elementi nel db, non sa cosa cercare
        if(isset(Post::orderBy('id', 'desc')->first()->id)){
            $lastPostId = (Post::orderBy('id', 'desc')->first()->id) +1;
        }else{
            $lastPostId = 0;
        }
        $newData['slug'] = Str::slug($newData['title'] . '' . $lastPostId, '-');
        $newData['post_date'] = new DateTime();

        // ? Aggiungendo i tags, la create non aiuta, non ci permette di recuperare i tags, li metterebbe nella sua colonna
        // $newPost->create($newData);

        // ? Usiamo quindi fill e save, e con sync() (messo necessariamente dopo), aggiungiamo i tags!
        $newPost->fill($newData);
        $newPost->save();
        $newPost->tags()->sync($newData['tags']);

        // ? mi faccio redirezionare nella show del nuovo post usando lo slug che arriva con upData!
        return redirect()->route('admin.posts.show', $newData['slug'])->with('session-change', $newData['title'] . ' ' . 'è stata aggiunta con successo!')
        ->with(['class' => 'alert-success']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        // ? per usarer la dependecy injecction: show (Post $post)
        // ? e fai solo il return, tutto qua. In index per passare le informazioni si passa con l'id
        // ?<a href="{{ route('admin.posts.show', $post->id) }}">Nome</a>
        // ! chiedi come far andare la show con URI slug usando la dependency injection!!!
        $post = Post::where('slug', $slug)->first();

        $idAuth = Auth::id();
        return view('admin.posts.show', compact('post', 'idAuth'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        // ? Dall'index mi passo lo slug, qui in edit becco il post cercandolo nel DB e lo salvo in variabile
        $post = Post::where('slug', $slug)->first();
        $tags = Tag::all();
        return view('admin.posts.edit', compact('post', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $upData = $request->all();

        $validateData = $request->validate(
            [
                'title' => [
                    'required',
                     'min:2', 
                     'max:100',
                    // FIXME Non funzia unique!
                    // Se il dato è unico, permette di inviare lo stesso, il problema nell'update avviene quando non viene modificato il titolo
                    // essendo già presente, senza questa regola non verrà aggiornato
                    // Rule::unique('posts')->ignore($upData['title'], 'title'),
                    ],
                    'post_image' => 'required|active_url|max:21844',
                    'post_content' => 'required|min:10|max:21844',
            ],
            [
                'post_image.active_url' => 'The image must be an active_url',
            ],
        );
        
        $upPost = Post::where('slug', $slug)->first();

        // ?aggiorno lo slug con il nuovo possibile titolo
        $upData['slug'] = Str::slug($upData['title']. ' ' . $upPost->id, '-');

        
        $upPost->update($upData);
        // ? sync anche qua dei tags! 
        // ! vedi anche in store!
        if(isset($upData['tags'])){
            $upPost->tags()->sync($upData['tags']);
        }else{
            $upData['tags'] = null;
            $upPost->tags()->sync($upData['tags']);
        }

        return redirect()->route('admin.posts.show', $upData['slug'])->with('session-change', $upData['title'] . ' ' . 'è stata modificata con successo!')
        ->with(['class' => 'alert-warning']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $delPost = Post::where('slug', $slug)->first();

        $delPost->delete();

        return redirect()->route('admin.posts.index')->with('status-change', $delPost->title  . ' ' . 'è stata eliminata con successo')->with(['class' => 'alert-danger']);
    }

}
