<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\NewsRequest;
use App\Http\Requests\NewsUpdateRequest;

class NewsController extends Controller
{
    /**
     * Определяем каким ролям какие доступны роуты
     *
     * NewsController constructor.
     */
    public function __construct()
    {
        $this->middleware('gate:admin',['only' => ['destroy']]);
        $this->middleware('gate:moderator',['only' => ['update', 'create', 'edit']]);
    }

    /**
     * Отображение списка новостей
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = auth()->user()->roles()->pluck('slug');
        $news = News::paginate(5);
        return view('news.index', compact('news','roles'));
    }

    /**
     * Отображение формы добавления новости
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('news.forms.create');
    }

    /**
     * Добавление полученных данных из формы в базу данных
     *
     * @param NewsRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(NewsRequest $request)
    {
        auth()->user()->news()->create($request->all());
        return redirect('/news')->with('info', 'Новость успешно добавлена');
    }

    /**
     * Отображение конкретной новости
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function show(News $news)
    {
        $user = $news->user;
        $roles = auth()->user()->roles()->pluck('slug');
        return view('news.show',compact('news','user','roles'));
    }

    /**
     * Отображение формы редактирования конкретной новости
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function edit(News $news)
    {
        return view('news.forms.edit', compact('news'));
    }

    /**
     * Обновление информации в базе данных о конкретной новости
     *
     * @param NewsUpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(NewsUpdateRequest $request, $id)
    {
        News::where('id', $id)->update($request->only(['title','content']));
        return redirect('/news')->with('info', 'Новость успешно изменена');
    }

    /**
     * Удаление конкретной новости
     *
     * @param News $news
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(News $news)
    {
        $news->delete();
        return redirect('/news')->with('info', 'Новость успешно удалена');
    }
}
