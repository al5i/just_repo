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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('content');
            $table->string('image');
            $table->unsignedBigInteger('category_id');
            $table->timestamps();


            $table->foreign('category_id') // Указываем поле в нашей таблице
            ->references('id')      // Поле, на которое будет ссылка
            ->on('categories')      // Таблица, на которую ссылаемся
            ->onDelete('cascade');
            $table->index('category_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');

        // Удаляем внешние ключи и индексы перед удалением таблицы
        Schema::table('posts', function (Blueprint $table) {
            $table->dropForeign(['category_id']); // Удаляем внешний ключ для category_id
            $table->dropIndex(['category_id']); // Удаляем индекс для category_id
        });
    }
};
