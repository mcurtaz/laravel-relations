<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// route che porta a una pagina che mostra la lista degli employees
Route::get('/', 'EmployeeController@index') -> name('employee-index');

// route che porta a una pagina che mostra diversi dati di uno specifico employee identificato grazie all'id
Route::get('/show/{id}', 'EmployeeController@show') -> name('employee-show');

// route che porta a una pagina con un form per creare un nuovo employee. Non richiede parametri
Route::get('/create', 'EmployeeController@create') -> name('employee-create');

// questa route ha lo stesso indirizzo della create ma cambia il metodo (quindi chiamerà un diverso metodo del controller in questo caso store). Al tasto submit della pagina create manderemo in post i dati del nuovo employee da creare. Il controller creerà il nuovo utente e reidirizzerà la view alla lista degli utenti. NOTE: alcuni nomi sono gli stessi che utilizza laravel quando crea in automatico le route per il CRUD (si, volendo si può far fare questo lavoro a laravel che creerà store, destroy, update ecc ecc. La particolarità di laravel è che utilizza sempre lo stesso url e cambia il metodo utilizzando DELETE, PUT/PATCH, GET, POST. sarebbe una best-practise usare tutti questi metodi ma nel mondo reale si usa quasi solo GET e POST. Per esempio nel mondo reale è improbabile cancellare definitivamente un tuple/riga da una tabella. Piuttosto è consuetudine usare una colonna deleted o visible con un booleano che ti dice se quel dato è "cancellato" o no, e si programma per comportarsi "come se" il dato fosse cancellato senza cancellarlo davvero)
Route::post('/create', 'EmployeeController@store') -> name('employee-store');

// La destroy cancella un tuple/riga dalla tabella employee. Prende come parametro l'id dell'employee da cancellare. è in GET, la controindicazione è che uno potrebbe cancellarti un employee mettendo nell'url del browser /destroy/(id dell'employee da cancellare). Si potrebbe aggirare il problema facendo questa route in post con dei magheggi nell'html ma per un caso scuola va bene anche in GET.
Route::get('/destroy/{id}', 'EmployeeController@destroy') -> name('employee-destroy');

// La edit rimanda ad una view con un form per aggiornare i dati di un employee. Prende come parametro l'id dell'employee da modificare. Nel form si troveranno già presenti i dati attuali che l'utente può modificare e salvare i dati aggiornati
Route::get('/edit/{id}', 'EmployeeController@edit') -> name('employee-edit');

// Dalla edit su questa route arrivano i dati aggiornati dell'employee. Arrivano con metodo POST. come paramentro prende l'id dell'employee da modificare, i dati aggiornati dall'utente si potranno prendere con Request $request nel controller. ATTENZIONE: nella action del form ci sarà la route con in più il paramentro $employee -> id per identificare l'employee da aggiornare. Per poter passare questo parametro però, anche se il metodo è POST va messo {id} nell'url della route. quindi se scrivessi solo Route::post('/update', 'EmployeeController.......) laravel mi darebbe errore del tipo two parameters needed but only one passed (o qualcosa del genere). Se invece nell'url ci metto /update/{id} lui sa che deve aspettarsi un parametro.
Route::post('/update/{id}', 'EmployeeController@update') -> name('employee-update');