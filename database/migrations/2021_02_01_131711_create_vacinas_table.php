<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVacinasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vacinas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('paciente_id');
            $table->foreign('paciente_id')->references('id')->on('usuarios');
            $table->integer('tipo')->comment('1 - Astrazeneca(Fiocruz) |2 - Coronavac(Butantan)|3 - Peizer|4 - Moderna|5 - Outro');
            $table->string('outro')->nullable();
            
            //1ª DOSE
            $table->date('dose1_data');
            $table->integer('dose1_lote')->nullable();
            $table->date('dose1_proxima_dose')->nullable();
            
            //2ª DOSE
            $table->date('dose2_data')->nullable();
            $table->integer('dose2_lote')->nullable();
            
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
        Schema::dropIfExists('vacinas');
    }
}
