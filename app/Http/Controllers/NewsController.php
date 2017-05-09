<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\NewsRequest;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = News::all();
        return view('news.index', compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = \Auth::user();
        foreach ($user->roles as $role) {
            if ($role->slug === 'admin' || $role->slug === 'moderator'){
                return view('news.forms.create');
            }else{
                return redirect('/news');
            }
        }
    }

    /**
     * Store a newly created resource in storage.
     * @param NewsRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(NewsRequest $request)
    {
        $news = new News;
        $news->title = $request->title;
        $news->content = $request->content;
        $news->user_id = \Auth::user()->id;

        $news->save();
        return redirect('/news')->with('info', 'Новость успешно добавлена');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function show(News $news)
    {
        $user = User::find($news->user_id);
        return view('news.show',compact('news','user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function edit(News $news)
    {
        return view('news.forms.edit', compact('news'));
    }

    /**
     * Update the specified resource in storage.
     * @param NewsRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(NewsRequest $request, $id)
    {
        $news = News::find($id);
        $news->title  = $request->title;
        $news->content = $request->content;

        $news->save();
        return redirect('/news')->with('info', 'Новость успешно изменена');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function destroy(News $news)
    {
        $user = \Auth::user();
        foreach ($user->roles as $role) {
            if ($role->slug === 'admin') {
                $news->delete();
                return redirect('/news')->with('info', 'Новость успешно удалена');
            }
        }
        return redirect('/news')->with('info', 'У вас нет прав для этого действия');
    }
}
