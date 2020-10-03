<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    // il model e` una rappresentazione nel ecosistema laravel di UNA tabella nel database. In questo caso e` la tabella employees. Non e` necessario specificarlo perche` laravel si aspetta da solo che la tabella employees avra` un model Employee. si puo` associare model e tabelle con nomi diversi ma e` piu` comodo seguire la nomenclatura laravel perche` molte cose cosi` le gestisce in automatico. il model si crea col comando php artisan make:model Nomemodel

    // l'attributo $fillable e` un attributo di default di laravel che serve per defini con un array quali chiavi della tabella si possono valorizzare. IMPORTANTE: mettere in fillable anche le chiavi esterne (tipo location_id). name, lastname e date_of_birth le valorizzeremo con la factory e il faker. location_id nel seeder prenderemo dei valori random dagli id della tabella locations. id created_at e updated_at li valorizzera` laravel in automatico
    protected $fillable = [
        'name',
        'lastname',	
        'date_of_birth',	
        'location_id'
    ];

    // per le chiavi esterne bisogna creare questi metodi che creano la relazione delle tabelle nel sistema laravel. cosa che permettera` di fare un sacco di cose ad esempio nel frontend useremo questi metodi per fare le join nelle query con una facilita` estrema e nei seeder di valorizzare foreign key andandole a cercare in altre tabelle. ATTENZIONE: tutto questo e` facilitato dalla nomenclatura laravel. Si puo` fare anche senza ma esplicitando molte piu` cose e compicando un po' il lavoro.

    // RELAZIONE UNO A MOLTI: la function al singolare e belongsTo. Nel model Location ci sara` il corrispondente function employees (plurale) hasMany. Perche` una location ha molti employees ma un employee lavora in una sola location. NOTE: si puo` scrivere belongsTo(Location::class) o belongsTo("App\Location")
 
    public function location(){
        return $this -> belongsTo(Location::class); // laravel ha cercato di rendere autodescrittive questi metodi. Ad esempio $this (employee perchè siamo nel model employee) appartiene a una location (infatti il metodo è al singolare). nel model location ci sarà una $this (cioè location) ha molti employees (plurale, nome metodo sarà al plurale)
    }

    // RELAZIONE MOLTI A MOLTI: la function al plurale (tasks) blongsToMany. $this (employee) appartiene a molti tasks. in task ci sara` il corrispettivo function employees (plurale) $this -> belongsToMany(Employee::class). una task ha molti employees.
    public function tasks(){
        return $this->belongsToMany(Task::class); // anche qui $this cioè employee appartiene a più tasks (plurale. tante tasks e tanti employees).
    }
}
