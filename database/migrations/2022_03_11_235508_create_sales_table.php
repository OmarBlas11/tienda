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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->decimal('total', $precision=5, $scale=2)->nullable();
            $table->decimal('pago', $precision=5, $scale=2)->nullable();
            $table->decimal('vuelto', $precision=5, $scale=2)->nullable();
            $table->string('fecha_venta');
            $table->string('hora');
            $table->string('day');
            $table->string('Month');
            $table->string('year');
            $table->string('semana');
            $table->unsignedBigInteger('table_id'); 
            $table->foreign('table_id')->references('id')->on('tables')->onDelete('cascade');

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
        Schema::dropIfExists('sales');
    }
};
