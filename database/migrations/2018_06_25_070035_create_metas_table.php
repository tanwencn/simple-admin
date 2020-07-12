<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMetasTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('metas', function(Blueprint $table)
        {
            $table->bigInteger('id', true)->unsigned();
            $table->bigInteger('target_id')->unsigned();
            $table->string('target_type', 255);
            $table->string('meta_key', 120)->default('');
            $table->string('meta_value', 255)->default('');
            $table->index(['target_id','target_type']);
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('user_metas');
    }

}
