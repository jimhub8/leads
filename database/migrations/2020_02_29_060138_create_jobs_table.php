<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->text('description')->nullable();
            $table->text('staff_comments')->nullable();
            $table->string('status')->default('pending');
            $table->dateTime('completed_on')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->dateTime('cancelled_on')->nullable();

            // $table->unsignedBigInteger('jobtype_id');
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('staff_id');

            $table->foreign('staff_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
            // $table->foreign('jobtype_id')->references('id')->on('jobtypes')->onDelete('cascade');
            $table->softDeletes();
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
        Schema::dropIfExists('jobs');
    }
}
