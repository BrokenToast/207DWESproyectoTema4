create database if not exists DAW207DBDepartamentos;
create user if not exists 'usuarioDAW207DBDepartamentos'@'%' IDENTIFIED BY 'paso';
use DAW207DBDepartamentos;
create table if not exists T02_Departamento(
    T02_CodDepartamento character(3) PRIMARY KEY,
    T02_DescDepartamento character(255)not null,
    T02_FechaDeCreacionDepartamento int not null,
    T02_VolumenDeNegocio float not null,
    T02_FechaBajaDepartamento int
)engine=innodb;
grant all privileges on DAW207DBDepartamentos.* to 'usuarioDAW207DBDepartamentos'@'%';
