<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->string('time')->change();
            $table->string('time_in_min');
            
            $table->string('firstname')->nullable();
            $table->string('lastname')->nullable();
            $table->date('birthdate')->nullable();
            $table->string('township')->nullable();
            $table->string('address')->nullable();
            $table->string('phonenumber')->nullable();
            $table->string('email')->nullable();

            $table->boolean('notify_if_earlier_appointment');
            $table->softDeletes();
            $table->unsignedBigInteger('client_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->dropColumn('time_in_min');
            $table->timestamp('time')->change();
            
            $table->dropColumn('firstname');
            $table->dropColumn('lastname');
            $table->dropColumn('birthdate');
            $table->dropColumn('township');
            $table->dropColumn('address');
            $table->dropColumn('phonenumber');
            $table->dropColumn('email');
            
            $table->dropColumn('notify_if_earlier_appointment');
            $table->dropColumn('deleted_at');
            $table->unsignedBigInteger('client_id')->change();
        });
    }
}