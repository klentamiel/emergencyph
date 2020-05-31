<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');;
            $table->string('first_name');
            $table->string('middle_name');
            $table->string('last_name');
            $table->string('nationality');
            $table->string('country');
            $table->date('birth_date');
            $table->string('birth_place');
            $table->string('id_type');
            $table->integer('id_number');
            $table->date('id_expiration');
            $table->string('id_link');
            $table->integer('contact_no');
            $table->string('permanent_address');
            $table->string('pa_baranggay');
            $table->string('pa_city');
            $table->string('pa_state');
            $table->integer('pa_zipcode');
            $table->string('pa_province');
            $table->string('current_address');
            $table->string('ca_baranggay');
            $table->string('ca_city');
            $table->string('ca_state');
            $table->integer('ca_zipcode');
            $table->string('ca_province');
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
        Schema::dropIfExists('user_profiles');

        Schema::table('user_profiles', function (Blueprint $table) {    
            $table->dropForeign('user_profiles_user_id_foreign');
        });
    }
}
