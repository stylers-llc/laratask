<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaskRuntimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task_runtimes', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('name_tx_id')->unsigned();

            $table->dateTime('start_at');
            $table->dateTime('end_at')->nullable();
            $table->boolean('exclude_start_date')->default(false);
            $table->string('date_interval')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('name_tx_id')->references('id')->on('taxonomies');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('task_runtimes', function (Blueprint $table) {
            $table->dropForeign(['name_tx_id']);
        });

        Schema::dropIfExists('task_runtimes');
    }
}
