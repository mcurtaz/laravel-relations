<?php

use Illuminate\Database\Seeder;
use App\Employee;
use App\Location;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // questo seeder è il secondo ad essere lanciato. Da notare che la tabella Locations è già stata popolata di dati fake. Useremo quei dati nella tabella location per andare a pescare dei location_id validi cioè che hanno effettivamente una corrispondenza nella tabella locations. Per questo serve "importare" anche il model di Location con use App\Location; oltre al model Employee con use App\Employee;

       factory(Employee::class, 50) -> make() // questo metodo popola la tabella di dati fake in base alla factory (nella factory si valorizzano tutti i campi tranne location_id). La differenza con create() è che make valorizza i campi ma non li salva nel database (il database non accetterebbe tuple senza location_id che non è nullable)
                                    -> each(function($emp){ // each concettualmente lavora come un foreach cioè scorre tutti gli elementi (tutte le righe create dal make per la tabella employee). $emp è di volta in volta l'n esimo elemento
                                        $loc = Location::inRandomOrder() -> first(); // inRandomOrder fa la stessa cosa di all() che prende tutti gli elementi presenti nella tabella ma in ordine random appunto. first() prende solo il primo della lista. Quindi avendo la lista completa sempre un ordine random diverso per ogni giro dell'each è come se prendessimo un elemento casuale dalla lista.
                                        $emp -> location() -> associate($loc); // dall'elemento emp (che è di volta in volta un tuple differente della tabella employees non ancora salvata nel database) chiamiamo il metodo location() che non è un nome a caso ma quello definito nel model Employee (tutto deve corrispondere comunque alla nomenclatura prevista da laravel). da qui si fa associate($loc) per associare a quella riga la corrispondente riga (presa precedentemente a random ) della tabella locations. Si valorizza così la location_id di quella riga.
                                        $emp -> save(); // A questo punto la riga completa di location_id viene salvata nel database con save()
                                    });
    }
}
