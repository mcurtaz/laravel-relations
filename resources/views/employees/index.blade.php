@extends('layouts.main-layout')
@section('content')
    <div class="content">
        <h2>Employees</h2>
        <ul>
            {{-- dal controller arriva $employees che contiene tutti i report della tabella employees. con un ciclo foreach ciclo sulla tabella e stampo in una lista nome e cognome di ogni employee --}}
            @foreach ($employees as $employee)
                <li>
                    {{-- il nome dell'employee è un link che richiama la route show passandogli l'id del rispettivo employee. la show rimanderà ad una view che mostrerà tutti i dati di quello specifico employee con quell'id --}}
                    <a href=" {{ route('employee-show', $employee -> id) }} ">
                        {{ $employee -> name }}
                        {{ $employee -> lastname }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
@endsection