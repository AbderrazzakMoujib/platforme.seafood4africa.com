<?php

// database/migrations/xxxx_xx_xx_xxxxxx_create_media_tables.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMediaTables extends Migration
{
    public function up()
    {
        Schema::create('pdfs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('file_path');
            $table->unsignedBigInteger('user_id'); // Foreign key to users table
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('file_path');
            $table->unsignedBigInteger('user_id'); // Foreign key to users table
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::create('audios', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('file_path');
            $table->unsignedBigInteger('user_id'); // Foreign key to users table
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('file_path');
            $table->unsignedBigInteger('user_id'); // Foreign key to users table
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('pdfs');
        Schema::dropIfExists('images');
        Schema::dropIfExists('audios');
        Schema::dropIfExists('videos');
    }
}

