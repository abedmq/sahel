<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLetterFilesTable extends \App\Classes\BaseMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('letter_files', function (Blueprint $table) {
            $this->addDefaultTable($table);
            $table->integer('letter_id');
            $table->integer('user_id');
            $table->json('variable');
            $table->integer('image');
            $table->string('image_preview')->nullable();
            $table->string('pdf_preview')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('letter_files');
    }
}
