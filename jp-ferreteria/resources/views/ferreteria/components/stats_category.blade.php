<!-- Estadísticas -->
<div class="stats">
    <div class="stat-card">
        <i class="fas fa-check-circle icon"></i>
        <p class="label">Categorías activas:</p>
        <p class="value">{{ $estadisticas['categorias_activas'] ?? 0 }}</p>
    </div>
    <div class="stat-card">
        <i class="fas fa-times-circle icon"></i>
        <p class="label">Categorías inactivas:</p>
        <p class="value">{{ $estadisticas['categorias_inactivas'] ?? 0 }}</p>
    </div>
</div>