<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    /**
     * Отключает создание в таблице полей created_at и updated_at
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Свзяь многие ко многим
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
