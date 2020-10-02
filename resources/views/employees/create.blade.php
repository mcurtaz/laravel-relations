@extends('layouts.main-layout')

@section('content')

<div class="content">
    <h2>Aggiorna Dati</h2>

    <form action=" {{ route('employee-store') }} " method="POST">
    @csrf
    @method('POST')
    <label for="name">Name</label>
    <input type="text" name="name">
    <label for="lastname">Last Name</label>
    <input type="text" name="lastname">
    <label for="date_of_birth">Date of birth</label>
    <input type="date" name="date_of_birth">
    <label for="location_id">Location</label>
    <select name="location_id">
        @foreach ($locations as $location)
            <option value=" {{ $location -> id }} "> {{ $location -> name }} </option>
        @endforeach
    </select>
    <button type="submit">Salva</button>
    </form>
</div>
@endsection

