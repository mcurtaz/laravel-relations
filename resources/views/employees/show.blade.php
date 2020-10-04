@extends('layouts.main-layout')
@section('content')

<div class="content">
    {{-- la show riceve $employee dal controller attraverso la compact() stampa a video tutti i dati di quell'employee --}}
    <h2>
        {{ $employee -> name }}
        {{ $employee -> lastname }}
    </h2>

    <ul>
        <li>
            Date of Birth: {{ $employee -> date_of_birth }}
        </li>
        <li>
            Location:
            {{-- ATTENZIONE: tutto il lavoro di creazione del database sfruttando per altro le automazioni di laravel qui da i suoi frutti. ogni employee ha una location referenziata nella tabella employees nella colonna location_id. si usa -> location (che non è un nome a caso ma quel metodo che abbiamo scritto nel Model con $this -> belongsTo(Location::class) è sia un metodo che un attributo. A livello teorico sarebbe da approfondire comunque all'atto pratico fa il suo). è come se automatizzasse quelle che nel MySQL sono le join tra due tabelle. location -> name stamperà il nome della location con l'id = a employee ->  location_id e stesso ragionamento per city--}}
            {{ $employee -> location -> name }} 
            (
            {{ $employee -> location -> city }}
            )
        </li>
    </ul>
    <h4>Tasks</h4>
    <ul>
        {{-- anche qua si utilizza il metodo tasks() scritto nel model di employee. laravel automatizza il lavoro quindi scrivendo $employee -> tasks si avranno tutti i task associati a l'employee in questione (cioè in questa pagina verranno visualizzati i dati dell'employee con uno specifico id. quell'employee_id nella tabella employee_task comparirà diverse volte associato a diversi task_id. con $employee -> task te li restituisce). con un ciclo foreach stampo la lista dei task --}}
        @foreach ($employee -> tasks as $task)
        
        <li>
            {{ $task -> name }}
        </li>
            
        @endforeach
    </ul>
    <div class="nav">
        <ul>
            {{-- questa route rimanda ad una view per aggiornare i dati del employee. per identificare l'emloyee corretto si passa come attributo l'id --}}
            <li><a href=" {{ route('employee-edit', $employee -> id) }} ">Update</a></li>
            {{-- la route destroy lancia la delete() per identificare quale employee cancellare si utilizza l'id. NOTE: con questo sistema la delete passa col metodo GET. href="" può passare solo GET. la controindicazione è che un utente potrebbe scrivere nell'url /delete/id per cancellare un employee. per adesso va bene così. Per farlo in POST bisognerebbe fare un form nascosto e far diventare quell delete con href un button submit sotto mentite spoglie (magari usando js) --}}
            <li><a href="{{ route('employee-destroy', $employee -> id) }}">Delete</a></li>
        </ul>
    </div> 

</div>
    
@endsection