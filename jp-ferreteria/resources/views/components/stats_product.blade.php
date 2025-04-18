<!-- Estadísticas -->
<div class="stats">
    <div class="stat-card">
        <i class="fas fa-box icon"></i>
        <p class="label">Productos en inventario:</p>
        <p class="value">{{ $estadisticas['inventario'] ?? 0 }}</p>
    </div>
    <div class="stat-card">
        <i class="fas fa-exclamation-triangle icon"></i>
        <p class="label">Bajo Stock:</p>
        <p class="value">{{ $estadisticas['bajo_stock'] ?? 0 }}</p>
    </div>
    <div class="stat-card">
        <i class="fas fa-ban icon"></i>
        <p class="label">Productos inactivos:</p>
        <p class="value">{{ $estadisticas['inactivos'] ?? 0 }}</p>
    </div>
</div>