{{-- Campos compartidos por los formularios de crear y editar --}}
<div class="row g-3">
    <div class="col-md-6">
        <label for="nombre" class="form-label">Nombre de la categoría *</label>
        <input type="text" id="nombre" name="nombre" maxlength="100" required
               value="{{ old('nombre', $categoria->nombre) }}"
               class="form-control @error('nombre') is-invalid @enderror">
        @error('nombre') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
        <label for="ubicacion" class="form-label">Ubicación *</label>
        <input type="text" id="ubicacion" name="ubicacion" maxlength="150" required placeholder="Ej.: Bodega piso 2"
               value="{{ old('ubicacion', $categoria->ubicacion) }}"
               class="form-control @error('ubicacion') is-invalid @enderror">
        @error('ubicacion') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-12">
        <label for="descripcion" class="form-label">Descripción</label>
        <textarea id="descripcion" name="descripcion" rows="3" maxlength="500"
                  class="form-control @error('descripcion') is-invalid @enderror">{{ old('descripcion', $categoria->descripcion) }}</textarea>
        @error('descripcion') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
        <label for="estado" class="form-label">Estado *</label>
        <select id="estado" name="estado" required class="form-select @error('estado') is-invalid @enderror">
            @foreach (\App\Models\Categoria::ESTADOS as $valor => $texto)
                <option value="{{ $valor }}" @selected(old('estado', $categoria->estado) === $valor)>{{ $texto }}</option>
            @endforeach
        </select>
        @error('estado') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
</div>

<div class="mt-4 d-flex gap-2">
    <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Guardar</button>
    <a href="{{ route('categorias.index') }}" class="btn btn-outline-secondary">Cancelar</a>
</div>
