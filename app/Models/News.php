<?php

namespace App\Models;
use Parsedown;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $fillable = ['title', 'slug', 'content'];

    /**
     * Обратное отношение «один ко многим»
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Автоматически генерирует slug для title новости
     * @param $value string - значение поля title (Название статьи)
     */
    public function setTitleAttribute($value) {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = str_slug($value);
    }

    /**
     * Удаляет опасный код
     * @param $value
     */
    public function setContentAttribute($value){
        $this->attributes['content'] = clean($value);
    }

    /**
     * Преобразует markdown в html
     * Для вывода в news.show использовать {!! $news->markdownContent !!}
     * @return string
     */
    public function getMarkdownContentAttribute() {
        return (new Parsedown)->text($this->attributes['content']);
    }
}
