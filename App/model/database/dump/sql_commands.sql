CREATE DATABASE jobs CHARACTER SET utf8 COLLATE utf8_general_ci;

CREATE DATABASE jobs CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;


-- Restore remote database
-- mysql -h mysql.empleos.click -u jobsterin -p jobsterin < D:\host\empleos.click\

-- mysql -u jobsterin -p -h mysql.empleos.click directorio_empresas

-- mysqldump -p -u root jobs job_empresa_directorio > D:/host/empleos.click/App/job_empresa_directorio.sql

SELECT
    TPS, TPS,
    count(*) as mi_contador
FROM
    directorio.empresa_directorio
-- WHERE
--    loquesea = algo
GROUP BY
    tps, tps