@extends('layouts.app')

@section('title', 'Editar equipo')

@section('content')
    <h1 class="h3 mb-3"><i class="bi bi-pencil-square"></i> Editar equipo {{ $equipo->codigo }}</h1>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('equipos.update', $equipo) }}" method="POST" novalidate>
                @csrf
                @method('PUT')
                @include('equipos._form')
            </form>
        </div>
    </div>
@endsection
