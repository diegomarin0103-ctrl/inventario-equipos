@extends('layouts.app')

@section('title', 'Nuevo equipo')

@section('content')
    <h1 class="h3 mb-3"><i class="bi bi-plus-circle"></i> Registrar equipo</h1>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('equipos.store') }}" method="POST" novalidate>
                @csrf
                @include('equipos._form')
            </form>
        </div>
    </div>
@endsection
