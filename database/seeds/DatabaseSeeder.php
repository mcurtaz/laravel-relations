<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // database seeder stabilisce quali seeder verranno chiamati e IN CHE ORDINE. è fondamentale l'ordine perchè in caso di foreign keys che referenziano dati in altre tabelle queste devono esistere prima. In questo caso l'ordine sarà location, employee e task. si passa nella funzione call un array con i seeder da chiamare nell'ordine in cui verranno chiamati. NOTE: php artisan migrate:refresh crea le tabelle nel database e le relaziona con eventuali chiavi esterne. I seeder popolano le tabelle di dati fake. per lanciare i seedere il comando è php artisan migrate:refresh --seed
        $this->call([LocationSeeder::class, 
                    EmployeeSeeder::class, 
                    TaskSeeder::class]);
    }
}
