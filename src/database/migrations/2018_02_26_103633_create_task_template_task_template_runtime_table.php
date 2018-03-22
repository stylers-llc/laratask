<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaskTemplateTaskTemplateRuntimeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task_template_tt_runtime', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('task_template_id')->unsigned();
            $table->integer('task_template_runtime_id')->unsigned();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('task_template_id')->references('id')->on('task_templates');
            $table->foreign('task_template_runtime_id')->references('id')->on('task_template_runtimes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('task_template_tt_runtime', function (Blueprint $table) {
            $table->dropForeign(['task_template_id']);
            $table->dropForeign(['task_template_runtime_id']);
        });

        Schema::dropIfExists('task_template_tt_runtime');
    }
}
