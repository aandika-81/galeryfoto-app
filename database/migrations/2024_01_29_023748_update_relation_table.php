<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateRelationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('album', function (Blueprint $table) {
            $table->foreign('users_id')->references('id')->on('users')->onUpdateCascade()->onDeleteCascade();
        });
        Schema::table('foto', function (Blueprint $table) {
            $table->foreign('users_id')->references('id')->on('users')->onUpdateCascade()->onDeleteCascade();
            $table->foreign('album_id')->references('id')->on('album')->onUpdateCascade()->onDeleteCascade();
        });
        Schema::table('komentar', function (Blueprint $table) {
            $table->foreign('users_id')->references('id')->on('users')->onUpdateCascade()->onDeleteCascade();
            $table->foreign('foto_id')->references('id')->on('foto')->onUpdateCascade()->onDeleteCascade();
        });
        Schema::table('like', function (Blueprint $table) {
            $table->foreign('users_id')->references('id')->on('users')->onUpdateCascade()->onDeleteCascade();
            $table->foreign('foto_id')->references('id')->on('foto')->onUpdateCascade()->onDeleteCascade();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
