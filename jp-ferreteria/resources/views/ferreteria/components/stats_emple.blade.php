<div class="stats">
    <div class="stat-card">
        <i class="fas fa-user icon"></i>
        <p class="label">Empleados activos:</p>
        <p class="value">{{ $estadisticas['activos'] ?? 0 }}</p>
    </div>

    <div class="stat-card">
        <i class="fas fa-user-slash icon"></i>
        <p class="label">Empleados Inactivos:</p>
        <p class="value">{{ $estadisticas['inactivos'] ?? 0 }}</p>
    </div>
</div>