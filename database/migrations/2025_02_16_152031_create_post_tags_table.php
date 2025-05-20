<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('post_tags', function (Blueprint $table) {
            // Поле для внешнего ключа на таблицу posts
            $table->unsignedBigInteger('post_id');
            $table->foreign('post_id')
                ->references('id')
                ->on('posts')
                ->onDelete('cascade'); // Удаляем связи, если пост удален

            // Поле для внешнего ключа на таблицу tags
            $table->unsignedBigInteger('tag_id');
            $table->foreign('tag_id')
                ->references('id')
                ->on('tags')
                ->onDelete('cascade'); // Удаляем связи, если тег удален

            $table->timestamps();

            // Создаем уникальный составной индекс для исключения дубликатов
            $table->unique(['post_id', 'tag_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_tags');

        Schema::table('post_tags', function (Blueprint $table) {
            // Сначала удаляем внешние ключи
            $table->dropForeign(['post_id']);
            $table->dropForeign(['tag_id']);
        });
    }
};
