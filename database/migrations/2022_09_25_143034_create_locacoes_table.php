<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocacoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locacoes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cliente_id')->constrained('clientes');
            $table->foreignId('carro_id')->constrained('carros');
            $table->dateTime('data_inicio_periodo');
            $table->dateTime('data_final_previsto_periodo');
            $table->dateTime('data_final_periodo')->nullable();
            $table->decimal('valor_diaria', 10, 2);
            $table->integer('km_inicial');
            $table->integer('km_final')->nullable();
            $table->boolean('veiculo_entregue')->default(0);
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
        Schema::dropIfExists('locacoes');
    }
}
