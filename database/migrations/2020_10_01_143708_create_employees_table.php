<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        // Le migration servono a lavorare sul server creando la struttura di tabelle e relazioni. DA TERMINALE comando php artisan make:migration create_nometabella_table. IMPORTANTE laravel utilizza una nomenclatura che se rispettata facilita molto il lavoro (ovviamente si puo` trasgredire ma bisogna esplicitare tante cose che rispettando la nomenclatura si possono omettere e vanno in automatico. e il senso dei framework: ti vincolano un po' a lavorare come dicono loro ma ti facilitano il lavoro. Non reinventare la ruota.) La nomenclatura prevede di utilizzare i nomi delle tabelle al PLURALE. i nomi dei model per esempio saranno al singolare e laravel sapra associare automaticamente la tabella al model corrispondente. ovviamente lavora solo in inglese.
        Schema::create('employees', function (Blueprint $table) {
            $table -> id();

            // con $table si creano le chiavi. i nomi delle colonne nel database. bisogna esplicitare il tipo di dato. nella documentazione laravel si trova l'elenco di tutti i tipi di dato possibili.
            $table -> string('name');
            $table -> string('lastname');
            $table -> date('date_of_birth');
            
            // location_id e` una chiave esterna sulla tabella location. IMPORTANTE: il tipo di dato dovra` essere esattamente lo stesso tipo di dato del riferimento nella tabella corrispondente. In questo caso qua verra` riportato l`id della tabella location ( di default tutti gli id in laravel sono bigInteger unsigned). Nella creazione della tabella si dichiara solo il nome della colonna e il tipo di dato. La relazione tra le due tabelle andra` esplicitata dopo (banalmente se lo facessimo adesso darebbe errore perche` la tabella locations ancora non esiste).

            //ATTENZIONE: location_id non e` un nome a caso. rientra in quelle che laravel utilizza come nomenclature standard che automatizzano certi passaggi.
            $table -> bigInteger('location_id') -> unsigned();

            $table -> timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // tutte le volte che lanciamo da terminale php artisan migrate:refresh lui esegue prima le funzioni down quindi eliminando tutte le tabelle e poi le funzioni up ricreando tutto il database
        Schema::dropIfExists('employees');
    }
}
