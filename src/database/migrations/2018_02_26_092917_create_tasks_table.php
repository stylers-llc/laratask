<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('task_template_id')->unsigned();
            $table->integer('status_tx_id');

            $table->integer('executable_id')->nullable();
            $table->string('executable_type')->nullable(); // User, Group etc.

            $table->dateTime('deadline_at');
            $table->dateTime('executed_at')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('status_tx_id')->references('id')->on('taxonomies');
            $table->foreign('task_executor_id')->references('id')->on('task_executor');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->dropForeign(['task_template_id']);
            $table->dropForeign(['status_tx_id']);
        });

        Schema::dropIfExists('tasks');
    }
}
