<?php

use Illuminate\Database\Seeder;
use App\Location;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // il seeder della tabella location è il più semplice in quanto la tabella non ha chiavi esterne. Verrà lanciato per primo e popolerà la tabella con dati fake creati dal faker nella factory. NOTE: è importante che sia richiamato il model della tabella corrispondente con use App\Location;
        factory(Location::class, 10) -> create();
    }
}
