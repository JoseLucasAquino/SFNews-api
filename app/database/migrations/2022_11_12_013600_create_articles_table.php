<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("id_article")->nullable()->unique();
            $table->string('title');
            $table->string('url');
            $table->string('image_url');
            $table->string('news_site');
            $table->text('summary');
            $table->date('published_at');
            $table->date('article_updated_at');
            $table->boolean('featured');
            $table->json('launches')->default(json_encode([]));
            $table->json('events')->default(json_encode([]));
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
}
