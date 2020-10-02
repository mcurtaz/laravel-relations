@extends('layouts.main-layout')

@section('content')

<div class="content">
    <h2>Aggiorna Dati</h2>

    <form action=" {{ route('employee-update', $employee -> id) }} " method="POST">
    @csrf
    @method('POST')
    <label for="name">Name</label>
    <input type="text" name="name" value="{{ $employee -> name }}">
    <label for="lastname">Last Name</label>
    <input type="text" name="lastname" value="{{ $employee -> lastname }}">
    <label for="date_of_birth">Date of birth</label>
    <input type="date" name="date_of_birth" value="{{ $employee -> date_of_birth }}">
    <label for="location_id">Location</label>
    <select name="location_id">
        @foreach ($locations as $location)
            <option 
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