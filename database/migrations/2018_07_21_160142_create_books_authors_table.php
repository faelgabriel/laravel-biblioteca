<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBooksAuthorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books_authors', function (Blueprint $table) {
            $table->unsignedInteger('book_id');
            $table->unsignedInteger('author_id');
            $table->timestamps();

            $table->index(["author_id"], 'books_authors_author_id_foreign');

            $table->index(["book_id"], 'books_authors_book_id_foreign');
            $table->foreign('author_id', 'books_authors_author_id_foreign')
                ->references('id')->on('authors')
                ->onDelete('restrict')
                ->onUpdate('restrict');

            $table->foreign('book_id', 'books_authors_book_id_foreign')
                ->references('id')->on('books')
                ->onDelete('restrict')
                ->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books_authors');
    }
}
