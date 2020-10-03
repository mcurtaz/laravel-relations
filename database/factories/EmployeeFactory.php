<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Employee;
use Faker\Generator as Faker;

// Nelle factory va "importato" il model con use App\Model; e richiamato nel $factory->define(Model::class
// Anche le factory si creano da riga di comando php artisan mak:factory nomeFactory. La factory ha il nome del Model al singolare
$factory->define(Employee::class, function (Faker $faker) {
    return [
        // il faker permette di assegnare dei dati finti alle righe della tabella. nella documentazione del faker ci sono tutti i tipi di dato che puo` creare (nomi, citta, date, numeri random, codici a barre ecc). Non si valorizzano qua le chiavi esterne perche` dovendo avere un valore che esiste in altre tabelle vanno create nel seeder studiando bene quali tabelle valorizzare per prime per poi andare a valorizzare le foreign key "pescando' tra i valori gia` assegnati
        'name'=> $faker -> firstname(),
        'lastname' => $faker -> lastName(),
        'date_of_birth' => $faker -> date()
    ];
});
