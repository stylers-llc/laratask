<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaskTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task_templates', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('name_tx_id')->unsigned();
            $table->integer('description_id')->unsigned()->nullable();

            $table->integer('taskable_id');
            $table->string('taskable_type'); // CalendarEvent, KPI etc.

            // delegated by
            $table->integer('delegatable_id')->nullable();
            $table->string('delegatable_type')->nullable(); // User, Group, Android etc.

            // delegated to
            $table->integer('assignable_id');
            $table->string('assignable_type'); // User, Group etc.

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('name_tx_id')->references('id')->on('taxonomies');
            $table->foreign('description_id')->references('id')->on('descriptions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('task_templates', function (Blueprint $table) {
            $table->dropForeign(['name_tx_id']);
            $table->dropForeign(['description_id']);
        });

        Schema::dropIfExists('task_templates');
    }
}
