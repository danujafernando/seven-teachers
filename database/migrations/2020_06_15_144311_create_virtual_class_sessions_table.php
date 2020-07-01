<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVirtualClassSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('virtual_class_sessions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('virtual_class_id')->unsigned();
            $table->date('virtual_class_date')->nullable();
            $table->integer('virtual_class_day')->nullable();
            $table->string('virtual_class_url')->nullable();
            $table->string('tute_url')->nullable();
            $table->boolean('extra_class')->default(0);
            $table->integer('extra_class_start_at')->default(0);
            $table->integer('extra_class_end_at')->default(0);
            $table->boolean('status')->default(1);
            $table->timestamps();

            $table->foreign('virtual_class_id')->references('id')->on('virtual_classes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('virtual_class_sessions');
    }
}
