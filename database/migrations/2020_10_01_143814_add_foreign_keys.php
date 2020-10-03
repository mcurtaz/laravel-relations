<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        // ATTENZIONE: questa e` una migration particolare. si crea col comando php artisan make:migration add_foreign_keys. Si occupa di creare le relazioni tra le tabelle. La cosa migliore e` che venga lanciata per ultima almeno tutte le tabelle sono gia` state create e non si rischiano errori. Laravel le migration le esegue in ordine alfabetico che chiamandosi con datacreazione_nome sono di default ordinate in ordine di creazione. In questo caso io l'ho creata per ultima ma per ottenere che sia eseguita per ultima si puo` rinominare MANTENENDO GLI UNDERSCORE quindi con 9999_99_99_999999_add_foreign_keys

        Schema::table('employees', function(Blueprint $table){

            // questo richiama un po' le altre location ma c'e` Schema::table e NON Schema::create. La sintassi e` abbastanza autodescrittiva cioe` nella Schema::table('employees') la location_id e` una chiave esterna che referenzia la colonna id sulla tabella locations. Da notare che i nomi delle tabelle sono al plurale. 'emp-loc' e` il nome (stavolta arbitrario si puo` chiamare anche pippo pluto) della relazione. servira` dopo perche` nella funzione down (che e` la prima che si lancia col comando php artisan migrate::refresh) serviranno i nomi delle relazioni da drop (eliminare). Se non droppi prima le relazioni non ti fa eliminare le tabelle quindi non riesci a fare il refresh del database
            $table -> foreign('location_id', 'emp-loc')
                    -> references('id')
                    -> on('locations');
        });

        Schema::table('employee_task', function(Blueprint $table){

             $table -> foreign('employee_id', 'tas-emp')
                     -> references('id')
                     -> on('employees')
                     // questa riga definisce come coportarsi in caso di eliminazione di una riga che ha una referenza in un altra` tabella. Esempio di questo caso: elimino un employee (impiegato). Nella tabella tasks (compiti) uno o piu` compiti sono assegnati a quell'impiegato (mediante l'id) per una questione di consistenza del database io non posso avere in una tabella un dato che si riferisce ad una cosa che non esiste (no dati inconsistenti). Questa cosa si risolve con: - impedisco di eliminare una  riga se viene riferenziata altrove nel database (che e` l'impostazione di default) - metto NULL dove c'e` referenziata quella riga (sempre se sia nullable) - elimino a cascata tutte le altre righe dove viene referenziata quella riga (che e` questo caso e si fa con onDelete('cascade'))
                     // questo e` un caso scuola quindi aggiriamo il problema cosi` e via. in un caso reale va studiata molto bene la scelta da fare in questi casi 
                     -> onDelete('cascade');
                     
                     $table -> foreign('task_id', 'emp-tas')
                     -> references('id')
                     -> on('tasks');
                     
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('employees', function (Blueprint $table) {
            // con queste righe si droppano le relazioni tra le tabelle. Va richiamato il nome che e` stato assegnato alle relazione nella funzione foreign()
            $table -> dropForeign('emp-loc');
        });

        Schema::table('employee_task', function (Blueprint $table) {
             $table -> dropForeign('tas-emp');
             $table -> dropForeign('emp-tas');
         });
    }
}
