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
        Schema::create('project_designator_progress_updates', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_designator_id');
            $table->foreign('project_designator_id', 'project_designators_foreign')
                ->references('id')
                ->on('project_designators')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('content')->nullable();
            $table->string('type', 20);
            $table->string('value')->nullable();
            $table->text('description')->nullable();
            $table->text('comment')->nullable();
            $table->foreignId('commented_by')->nullable()->constrained('users');
            $table->string('status', 20);
            $table->foreignId('uploaded_by')->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('project_designator_documentations');
    }
};
