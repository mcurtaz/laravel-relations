@extends('layouts.main-layout')

@section('content')

<div class="content">
    <h2>Aggiorna Dati</h2>
    {{-- queast è una view che permette di creare un nuovo tuple. il controller con la compact passa $locations con tutte le location. Questo serve perchè nella colonna location_id del employee creato deve avere un id che nella tabella locations esiste (consistenza del database) --}}
    <form action=" {{ route('employee-store') }} " method="POST">
    {{-- csrf è una sicurezza di laravel. crea un codice che poi laravel verifica per sapere che l'origine della query è "interna". poi si definisce il metodo --}}
    @csrf
    @method('POST')
    {{-- la cosa FONDAMENTALE del form è che ci sia corrispondenza tra i value="" dei vari input e i nomi delle chiavi (colonne) della tabella --}}
    <label for="name">Name</label>
    <input type="text" name="name">
    <label for="lastname">Last Name</label>
    <input type="text" name="lastname">
    <label for="date_of_birth">Date of birth</label>
    <input type="date" name="date_of_birth">
    <label for="location_id">Location</label>
    <select name="location_id">
        @foreach ($locations as $location)
        {{-- creo una option per ogni location. per l'utente metto il nome della location (l'id sarebbe poco significativo) NOTE: nel value devo mettere l'id perchè il valore da salvare nella tabella employees è location_id --}}
            <option value=" {{ $location -> id }} "> {{ $location -> name }} </option>
        @endforeach
    </select>
    <button type="submit">Salva</button>
    </form>
</div>
@endsection

