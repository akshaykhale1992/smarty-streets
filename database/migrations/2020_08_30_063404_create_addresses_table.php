<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->string('address');
            $table->string('city');
            $table->string('state', 2);
            $table->string('zipcode', 8);
            // $table->tinyInteger('property_type'); // Can be enabled and property_type can be used as Flag Values
            $table->enum('property_type', ['single_home', 'condo', 'multifamily', 'land', 'other']);
            $table->string('longitude');
            $table->string('latitude');
            $table->string('sa_country');
            $table->string('ga_country');
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
        Schema::dropIfExists('addresses');
    }
}
