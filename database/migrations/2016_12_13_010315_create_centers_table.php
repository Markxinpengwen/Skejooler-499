<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCentersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('centers', function (Blueprint $table) {
            $table->integer('cid')->unsigned(); //*1
            $table->foreign('cid')->references('uid')->on('Users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('cname')->nullable(false);
            $table->string('email')->nullable();
            $table->string('phone',11)->nullable();
            $table->string('description',1000)->nullable();
            $table->boolean('canSupportOnlineExam');
            $table->decimal('cost',6,2)->nullable();
            //Address
            $table->string('street_name')->nullable(false);
            $table->string('city')->nullable(false);
            $table->enum('province', ['British_Columbia','Alberta','Sasketchewan', 'Manitoba','Ontario','Quebec','Nova_Scotia','Newfoundland_and_Labrador', 'New_Brunswick', 'Prince_Edward_Island','Yukon','Northwest_Territories', 'Nunavut'])->default('British_Columbia')->nullable(false);
            $table->enum('country', ['Canada'])->default('Canada')->nullable(false);
            $table->string('postal_code',6)->nullable(false);
            $table->float('longitude',10,6)->default(NULL)->nullable();
            $table->float('latitude',10,6)->default(NULL)->nullable();
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
        Schema::dropIfExists('centers');
    }
}
