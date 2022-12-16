<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('review', function (Blueprint $table) {
            $table->id();
            $table->foreignId('iduser');
            $table->string('nombre', 80);
            $table->enum('tipo', ['film', 'record', 'book']);
            $table->string('review', 300);
            $table->binary('thumbnail');
            $table->timestamps();
            
            $table->foreign('iduser')->references('id')->on('users');
        });
        $sql = 'alter table review change thumbnail thumbnail longblob';
        DB::statement($sql);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('review');
    }
};
