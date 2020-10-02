@extends('layouts.main-layout')
@section('content')
    <div class="content">
        <h2>Employees</h2>
        <ul>
            @foreach ($employees as $employee)
                <li>
                    {{ $employee -> name }}
                    {{ $employee -> lastname }}
                </li>
            @endforeach
        </ul>
    </div>
@endsection