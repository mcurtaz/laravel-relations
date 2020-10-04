<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;
use App\Location;

class EmployeeController extends Controller
{
    public function index(){

        // La index prende tutti gli employee con ::all() e li manda con la compact alla view che farà un ciclo e stamperà la lista degli employee. Per utilizzare Employee bisogna prima "importarlo" con use App\Employee;
        $employees = Employee::all();

        return view('employees.index', compact('employees'));
    }

    public function show($id){
        
        // la show prende solo l'employee richiesto dall'utente. ::findOrFail trova l'employee con quell'id e lo salva nella variabile che verrà passata con la compact alla view che stamperà diversi dati di quello specifico utente. 
        $employee = Employee::findOrFail($id);

        return view('employees.show', compact('employee'));
    }

    public function create(){

        // La create rimanda ad una view con un form per creare un nuovo utente. Dobbiamo passargli tutte le location disponibili perchè nella tabella employees c'è una foreign keys che referenzia la tabella locations quindi per creare un nuovo employee dobbiamo mettergli nella colonna location_id un id valido (presente nella tabella locations). Mandandogli tutte le location nella view creeremo una select con cui l'utente potrà scegliere tra le location disponibili. Per utilizzare Location::all() bisogna prima "importarla" con use App\Location;
        $locations = Location::all();

        return view('employees.create', compact('locations'));
    }

    public function store(Request $request){
       
        // dalla create arrivano con metodo POST i dati del nuovo employee da creare. i dati si possono prendere con Request $request. Però non possiamo passare direttamente $request al metodo ::create() che crea effettivamente un nuovo employee. Con ->all() possiamo ottenere da $request un oggetto che la ::create() accetta. Così creiamo un nuovo employee e poi facciamo un return redirect() che rimanda alla view con la lista degli employees
        $data = $request -> all();

        Employee::create($data);

        return redirect() -> route('employee-index');
    }

    public function destroy($id){

        // la destroy serve ad eliminare un tuple/riga dalla tabella employees. Con l'id (mandato tramite la route o con l'url) recupero quale degli employee cancellare. Si utilizza la findOrFail(). Trovato l'employee semplicemente metodo delete(). poi si fa un return redirect() sulla view con la lista degli employees
        $employee = Employee::findOrFail($id);

        $employee -> delete();

        return redirect() -> route('employee-index');
    }

    public function edit($id){

        // la edit rimanda ad una view dove si possono aggiornare i dati di un employee. Prende l'id dell'employee da modificare come parametro (arriverà dal link o dall url nel browser). Cerca l'employee da modificare nella tabella employees con il metodo ::findOrFail().
        $employee = Employee::findOrFail($id);

        // come nella create serve tutta la lista delle location in modo che l'utente possa mettere una chiave esterna location_id che sia effettivamente un id che esiste nella tabella locations. nel form di modifica dei dati dell'employee ci sarà una select con la lista di tutte le location presenti nella tabella locations.
        $locations = Location::all();

        // sia i dati dell'employee da modificare che tutte le locations vengono passate con la compact alla view
        return view('employees.edit', compact('employee', 'locations'));
    }

    public function update(Request $request, $id){
        
        // i dati del form nella edit vengono mandati con metodo POST. si possono recuperare con Request $request. l'altro paramentro è l'id dell'employee da modificare. Con ::findOrFail() trovo l'employee con l'id corrispondente. anche al metodo update() non si può passare direttamente $request. si utilizza il metodo ->all() per ottenere un oggetto da passare a update(). Sull'employee trovato con la findOrFail() lancio il matodo update() mandandogli come argomento $data. Infine la solita return redirect() sulla lista degli employees
        $employee = Employee::findOrFail($id);

        $data = $request -> all();

        $employee -> update($data);

        return redirect() -> route('employee-index');
    }
}
