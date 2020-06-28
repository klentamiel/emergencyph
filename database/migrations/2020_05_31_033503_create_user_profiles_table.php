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
            $table->string('first_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();
            $table->longtext('profile_pic')->nullable();
            $table->string('nationality')->nullable();
            $table->string('country')->nullable();
            $table->date('birth_date')->nullable();
            $table->string('birth_place')->nullable();
            $table->string('id_type')->nullable();
            $table->string('id_number')->nullable();
            $table->date('id_expiration')->nullable();
            $table->longtext('id_front')->nullable();
            $table->longtext('id_back')->nullable();
            $table->string('contact_no')->nullable();
            $table->string('permanent_address')->nullable();
            $table->string('pa_baranggay')->nullable();
            $table->string('pa_city')->nullable();
            $table->string('pa_state')->nullable();
            $table->integer('pa_zipcode')->nullable();
            $table->string('pa_province')->nullable();
            $table->string('current_address')->nullable();
            $table->string('ca_baranggay')->nullable();
            $table->string('ca_city')->nullable();
            $table->string('ca_state')->nullable();
            $table->integer('ca_zipcode')->nullable();
            $table->string('ca_province')->nullable();
            $table->string('ca_same_pa')->default('yes');
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
