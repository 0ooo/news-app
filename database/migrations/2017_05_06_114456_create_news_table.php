<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsTable extends Migration
{
    /**
     * @throws Exception
     */
    public function up()
    {
        try {
            Schema::create('news', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('user_id')->unsigned();
                $table->string('title',256);
                $table->string('slug')->unique();
                $table->text('content');
                $table->timestamps();
            });
        } catch (\Exception $e) {
            $this->down();
            throw  $e;
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('news');
    }
}
