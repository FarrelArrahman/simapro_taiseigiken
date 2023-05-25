<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('project_designators', function (Blueprint $table) {
            $table->date('begin_date')->after('designated_by')->nullable();
            $table->date('finish_date')->after('begin_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('project_designators', function (Blueprint $table) {
            $table->dropColumn(['begin_date', 'finish_date']);
        });
    }
};
