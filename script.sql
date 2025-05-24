select * from contrato_servicio;

-- Desactivar el modo seguro temporalmente
SET SQL_SAFE_UPDATES = 0;

-- Contar total de registros
SELECT COUNT(*) AS total_registros FROM contrato_servicio;

-- Ver un ejemplo de cómo quedarán los datos
SELECT 
    id,
    fecha_servicio AS fecha_original,
    CONCAT('2025-01-01 ', TIME(fecha_servicio)) AS nueva_fecha
FROM contrato_servicio
LIMIT 10;

-- Actualización masiva
UPDATE contrato_servicio
SET fecha_servicio = CONCAT('2025-01-01 ', TIME(fecha_servicio));

-- Verificación después de la actualización
SELECT id, fecha_servicio FROM contrato_servicio LIMIT 10;

-- Reactivar el modo seguro
SET SQL_SAFE_UPDATES = 1;