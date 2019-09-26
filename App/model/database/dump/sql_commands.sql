CREATE DATABASE jobs CHARACTER SET utf8 COLLATE utf8_general_ci;

CREATE DATABASE jobs CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;


-- Restore remote database
-- mysql -h mysql.empleos.click -u jobsterin -p jobsterin < D:\host\empleos.click\

-- mysql -u jobsterin -p -h mysql.empleos.click directorio_empresas

-- mysqldump -p -u root jobs job_empresa_directorio > D:/host/empleos.click/App/job_empresa_directorio.sql

-- mysqldump -h mysql.empleos.click -p -u jobsterin jobsterin > D:/host/empleos.click/App/jobs_prod.sql
-- mysqldump -h 127.0.0.1 --port=3307 -p -u root jobs > D:/host/empleos.click/App/jobs_local.sql

SELECT count(*) FROM jobs.job_empresa_directorio WHERE TPS='SOCIEDAD DE RESPONSABILIDAD LIMITADA' AND (MUNICIPIO='LA PAZ' OR MUNICIPIO='EL ALTO') AND ULT_RENOV > 2014;

select DPTO, count(DPTO)
from jobs.job_empresa_directorio
group by DPTO;

select MUNICIPIO, count(MUNICIPIO)
from jobs.job_empresa_directorio
group by MUNICIPIO;

select TPS, count(TPS)
from jobs.job_empresa_directorio
group by TPS;
