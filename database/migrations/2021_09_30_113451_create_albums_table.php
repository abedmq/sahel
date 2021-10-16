<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlbumsTable extends \App\Classes\BaseMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('albums', function (Blueprint $table) {
            $this->addDefaultTable($table);
            $table->string('title');
            $table->string('type')->default('attachment');
            $table->string('attachment_type')->nullable();
            $table->boolean('is_system')->default(0);
        });

        \App\Models\Album::create(['title' => 'مرفقات سنوية', 'type' => 'ready_attachment', 'attachment_type' => 'annual_report','is_system'=>1]);
        \App\Models\Album::create(['title' => 'وقف الدورات القرآنية', 'type' => 'ready_attachment', 'attachment_type' => 'quranic_courses','is_system'=>1]);
        \App\Models\Album::create(['title' => 'ملفات الاستقطاع', 'type' => 'ready_attachment', 'attachment_type' => 'cut-off_files','is_system'=>1]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('albums');
    }
}
