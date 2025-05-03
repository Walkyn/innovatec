<script>
    // Función para verificar nuevas notificaciones
    function verificarNuevasNotificaciones() {
        fetch('/obtener-pagos')
            .then(response => response.json())
            .then(pagosActuales => {
                const pagosVistosStr = localStorage.getItem('pagos_vistos') || '[]';
                let pagosVistos;
                
                try {
                    pagosVistos = JSON.parse(pagosVistosStr);
                } catch (e) {
                    pagosVistos = [];
                    console.error('Error al parsear pagos_vistos:', e);
                }
                
                // Crear mapa para búsqueda rápida de pagos vistos
                const mapaPagosVistos = new Map();
                pagosVistos.forEach(pago => {
                    if (pago && pago.id) {
                        mapaPagosVistos.set(pago.id, {
                            estado: pago.estado,
                            updated_at: pago.updated_at
                        });
                    }
                });
                
                // Contar pagos nuevos o con estado cambiado
                let contadorNuevos = 0;
                
                pagosActuales.forEach(pago => {
                    const pagoVisto = mapaPagosVistos.get(pago.id);
                    
                    // Es nuevo o cambió su estado o se actualizó después
                    if (!pagoVisto || 
                        pagoVisto.estado !== pago.estado || 
                        new Date(pago.updated_at) > new Date(pagoVisto.updated_at)) {
                        contadorNuevos++;
                    }
                });
                
                // Actualizar contador en la interfaz
                const badgeElement = document.getElementById('nuevos-mensajes-badge');
                if (badgeElement) {
                    if (contadorNuevos > 0) {
                        badgeElement.textContent = contadorNuevos;
                        badgeElement.classList.remove('hidden');
                    } else {
                        badgeElement.textContent = '0';
                        if (window.location.pathname !== '/panel/mensajes') {
                            badgeElement.classList.remove('hidden');
                        } else {
                            badgeElement.classList.add('hidden');
                        }
                    }
                }
            })
            .catch(error => console.error('Error al verificar notificaciones:', error));
    }

    // Ejecutar verificación al cargar la página
    document.addEventListener('DOMContentLoaded', function() {
        // Verificar inmediatamente al cargar
        verificarNuevasNotificaciones();
        
        // Verificar cada 30 segundos
        setInterval(verificarNuevasNotificaciones, 30000);
        
        // También verificar cuando la ventana obtiene el foco
        window.addEventListener('focus', verificarNuevasNotificaciones);
        
        // Escuchar cambios en el localStorage desde otras pestañas
        window.addEventListener('storage', function(e) {
            if (e.key === 'pagos_vistos') {
                verificarNuevasNotificaciones();
            }
        });
    });
</script> 