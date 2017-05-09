<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesTable extends Migration
{
    /**
     * @throws Exception
     */
    public function up()
    {
        try {
            Schema::create('roles', function (Blueprint $table) {
                $table->increments('id');
                $table->string('slug')->unique();
            });
            Schema::create('role_user', function (Blueprint $table) {
                $table->integer('role_id')->unsigned();
                $table->integer('user_id')->unsigned();

                $table->foreign('role_id')->references('id')->on('roles')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');

                $table->foreign('user_id')->references('id')->on('users')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');

                $table->primary(['role_id','user_id'],'role_user_pk');
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
        // а дропать role_user кто будет?
        Schema::dropIfExists('roles');
    }
}
