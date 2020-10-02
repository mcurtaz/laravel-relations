@extends('layouts.main-layout')
@section('content')
    <div class="content">
        <h2>Employees</h2>
        <ul>
            @foreach ($employees as $employee)
                <li>
                    <a href=" {{ route('employee-show', $employee -> id) }} ">
                        {{ $employee -> name }}
                        {{ $employee -> lastname }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
@endsection