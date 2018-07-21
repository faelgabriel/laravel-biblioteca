<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBooksLendingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books_lendings', function (Blueprint $table) {
            $table->unsignedInteger('lending_id');
            $table->unsignedInteger('book_id');

            $table->index(["book_id"], 'books_lendings_book_id_foreign');

            $table->index(["lending_id"], 'books_lendings_lending_id_foreign');
            $table->timestamps();


            $table->foreign('book_id', 'books_lendings_book_id_foreign')
                ->references('id')->on('books')
                ->onDelete('restrict')
                ->onUpdate('restrict');

            $table->foreign('lending_id', 'books_lendings_lending_id_foreign')
                ->references('id')->on('lendings')
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
        Schema::dropIfExists('books_lendings');
    }
}
