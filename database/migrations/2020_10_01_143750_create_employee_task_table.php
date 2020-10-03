<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


// ATTENZIONE: Per le tabelle ponte come questa (le tabelle ponte servono a gestire le relazioni molti a molti un employee puo` essere assegnato a 0, 1 o piu` task. e un task puo` essere svolto da 0, 1 o piu` employee) la nomenclatura di laravel prevede una struttura precisa. NOMI DELLE TABELLE AL SINGOLARE IN ORDINE ALFABETICO. in questo caso php artisan make:migration create_employee_task_table



class CreateEmployeeTaskTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_task', function (Blueprint $table) {
            $table->id();

            // Qua sono presenti due chiavi esterne sull'id di employee e di task. ogni riga sara` un associazione tra tale id di employee e tale id di task. In questo modo possiamo associare per ogni employee quanti task vogliamo e viceversa.
            $table -> bigInteger('employee_id') -> unsigned();
            $table -> bigInteger('task_id') -> unsigned();

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
        Schema::dropIfExists('employee_task');
    }
}
