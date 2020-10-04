@extends('layouts.main-layout')

@section('content')

<div class="content">
    <h2>Aggiorna Dati</h2>

    <form action=" {{ route('employee-update', $employee -> id) }} " method="POST">
    @csrf
    @method('POST')
    {{-- la edit è simile alla create ma non si crea una nuova riga nella tabella ma se ne modifica una già esistente quindi verrà passato l'id della riga da modificare. Nel form (che è identico a quello della create) vengo visualizzati i dati della riga già esistente, l'utente può modificare uno o più datio e salvare l'employee aggiornato. quindi nei value degli input ci sarà il dato già esistente (ad esempio come value dell'input name ci sarà il valore di $employee -> name) --}}
    <label for="name">Name</label>
    <input type="text" name="name" value="{{ $employee -> name }}">
    <label for="lastname">Last Name</label>
    <input type="text" name="lastname" value="{{ $employee -> lastname }}">
    <label for="date_of_birth">Date of birth</label>
    {{-- NOTE: per date_of_birth che è un input di tipo date il value deve essere value="{{ $employee -> date_of_birth }}" se si scrive value=" {{ $employee -> date_of_birth }} " cioè con gli spazi tra le virgolette e le graffe il value risulta con gli spazi e non solo i caratteri della data quindi il browser non riesce a interpretarlo come data e mostrarlo come valore di default dell'input --}}
    <input type="date" name="date_of_birth" value="{{ $employee -> date_of_birth }}">
    <label for="location_id">Location</label>
    <select name="location_id">
        {{-- nella compact() mandata dal controller ci sarà sia l'employee da modificare sia tutte le location. nella select (come nella create) si stampano tutte le location con il name visualizzato dall'utente e l'id come value della option (infatti questo andrà salvato nella tabella location_id dell'employee perchè la foreign key referenzia l'id della tabella locations) --}}
        @foreach ($locations as $location)
            <option 
            {{-- si aggiunge un if che semplicemente se la location_id dell'employee che stiamo modificando è uguale all'id della location che stiamo stampando nella option (stiamo ciclando su tutte le location e stampando una option per ognuna) aggiungiamo l'attributo selected in modo che nella pagina sia di default selezionata la location in cui si trova l'employee --}}
            @if ($employee -> location_id == $location -> id)
                selected
            @endif
            value=" {{ $location -> id }} "> 
            {{ $location -> name }} 
            </option>
        @endforeach
    </select>
    <button type="submit">Salva</button>
    </form>
</div>
@endsection