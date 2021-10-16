<?php

namespace App\Classes;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class BaseMigration extends Migration
{
    /**
     * @param Blueprint $table
     */
    function addDefaultTable(Blueprint $table, $withoutAdmin = false)
    {
        $table->id();
        if (!$withoutAdmin)
            $table->integer('admin_id');

        $table->integer('status')->default(1);
        $table->integer('sort')->default(1);
        $table->timestamps();
        $table->softDeletes();
    }
}
