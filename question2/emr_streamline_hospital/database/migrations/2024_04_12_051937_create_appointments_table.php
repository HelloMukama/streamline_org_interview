<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('patient_id')->constrained()->onDelete('cascade');
            // $table->foreignId('clinic_id')->constrained()->onDelete('cascade');
            // $table->foreignId('staff_id')->constrained('users')->onDelete('cascade');
            
            $table->unsignedBigInteger('patient_id');
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');

            $table->unsignedBigInteger('clinic_id');
            $table->foreign('clinic_id')->references('id')->on('clinics')->onDelete('cascade');

            $table->unsignedBigInteger('staff_id');
            $table->foreign('staff_id')->references('id')->on('users')->onDelete('cascade');

            $table->text('clinical_notes')->nullable();
            $table->dateTime('date_and_time');
            $table->enum('status', ['postponed', 'brought_forward', 'canceled', 'started', 'completed']);
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
        Schema::dropIfExists('appointments');
    }
}
