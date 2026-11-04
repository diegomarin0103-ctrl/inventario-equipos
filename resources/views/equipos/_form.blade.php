{{-- Campos compartidos por los formularios de crear y editar --}}
<div class="row g-3">
    <div class="col-md-4">
        <label for="codigo" class="form-label">Código del equipo *</label>
        <input type="text" id="codigo" name="codigo" maxlength="30" required
               value="{{ old('codigo', $equipo->codigo) }}"
               class="form-control @error('codigo') is-invalid @enderror">
        @error('codigo') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-8">
        <label for="nombre" class="form-label">Nombre del equipo *</label>
        <input type="text" id="nombre" name="nombre" maxlength="100" required
               value="{{ old('nombre', $equipo->nombre) }}"
               class="form-control @error('nombre') is-invalid @enderror">
        @error('nombre') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-4">
        <label for="marca" class="form-label">Marca *</label>
        <input type="text" id="marca" name="marca" maxlength="60" required
               value="{{ old('marca', $equipo->marca) }}"
               class="form-control @error('marca') is-invalid @enderror">
        @error('marca') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-4">
        <label for="modelo" class="form-label">Modelo *</label>
        <input type="text" id="modelo" name="modelo" maxlength="60" required
               value="{{ old('modelo', $equipo->modelo) }}"
               class="form-control @error('modelo') is-invalid @enderror">
        @error('modelo') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-4">
        <label for="numero_serie" class="form-label">Número de serie *</label>
        <input type="text" id="numero_serie" name="numero_serie" maxlength="80" required
               value="{{ old('numero_serie', $equipo->numero_serie) }}"
               class="form-control @error('numero_serie') is-invalid @enderror">
        @error('numero_serie') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
        <label for="estado" class="form-label">Estado *</label>
        <select id="estado" name="estado" required class="form-select @error('estado') is-invalid @enderror">
            <option value="">Seleccione…</option>
            @foreach (\App\Models\Equipo::ESTADOS as $valor => $texto)
                <option value="{{ $valor }}" @selected(old('estado', $equipo->estado) === $valor)>{{ $texto }}</option>
            @endforeach
        </select>
        @error('estado') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
        <label for="fecha_adquisicion" class="form-label">Fecha de adquisición *</label>
        <input type="date" id="fecha_adquisicion" name="fecha_adquisicion" required max="{{ now()->toDateString() }}"
               value="{{ old('fecha_adquisicion', $equipo->fecha_adquisicion?->format('Y-m-d')) }}"
               class="form-control @error('fecha_adquisicion') is-invalid @enderror">
        @error('fecha_adquisicion') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
</div>

<div class="mt-4 d-flex gap-2">
    <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Guardar</button>
    <a href="{{ route('equipos.index') }}" class="btn btn-outline-secondary">Cancelar</a>
</div>
