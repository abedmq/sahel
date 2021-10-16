<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettings extends Migration {

    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->string('key')->primary();
            $table->text('value');

            //

            $table->timestamps();
        });

        \App\Models\Setting::addORUpdate([
            'title'           => 'منصة سهل',
            'description'  => 'منصة متخصصة لتسهيل عمل الموظفين',
            'metadata'  => 'منصة سهل',
            'logo'  => 'front/media/logos/logo-letter-1.png',
//            'tax_rate'             => 0,
//            'price_pre_bring'      => 8,
//            'added_estimate_price' => 10,
//            'check_price'          => 0,
        ]);
        \Illuminate\Support\Facades\Cache::forget('settings');
    }

    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
