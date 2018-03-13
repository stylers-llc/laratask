<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyTaskTemplateTaskRuntimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('task_template_tt_runtime', function (Blueprint $table){
            $table->dateTime('next_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('task_template_tt_runtime', function (Blueprint $table){
            $table->dropColumn('next_at');
        });
    }
}
