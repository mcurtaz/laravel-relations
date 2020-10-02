@extends('layouts.main-layout')
@section('content')

<div class="content">

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
            {{ $employee -> location -> name }} 
            (
            {{ $employee -> location -> city }}
            )
        </li>
    </ul>
    <h4>Tasks</h4>
    <ul>
        @foreach ($employee -> tasks as $task)
        
        <li>
            {{ $task -> name }}
        </li>
            
        @endforeach
    </ul>
    <div class="nav">
        <ul>
            <li><a href=" {{ route('employee-edit', $employee -> id) }} ">Update</a></li>
            <li><a href="{{ route('employee-destroy', $employee -> id) }}">Delete</a></li>
        </ul>
    </div> 

</div>
    
@endsection