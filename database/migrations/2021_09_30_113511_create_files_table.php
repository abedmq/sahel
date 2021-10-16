<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilesTable extends \App\Classes\BaseMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $this->addDefaultTable($table);

            $table->string('title');
            $table->string('url');
            $table->string('original_name')->nullable();
            $table->string('size')->nullable();
            $table->string('type');
            $table->string('file_type')->default('attachment');
            $table->integer('album_id')->nullable();
            $table->integer('user_id');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('files');
    }
}
