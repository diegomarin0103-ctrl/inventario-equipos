<li class="nav-item">
    <a class="nav-link {{ request()->routeIs('equipos.*') ? 'active fw-semibold' : '' }}" href="{{ route('equipos.index') }}">
        <i class="bi bi-laptop"></i> Equipos
    </a>
</li>
<li class="nav-item">
    <a class="nav-link {{ request()->routeIs('categorias.*') ? 'active fw-semibold' : '' }}" href="{{ route('categorias.index') }}">
        <i class="bi bi-tags"></i> Categorías
    </a>
</li>
