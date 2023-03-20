CREATE DATABASE gimnasio;
USE gimnasio;

CREATE TABLE usuario(
    id_user int primary key auto_increment,
    activo boolean not null,
    nombre varchar(50) not null unique,
    clave varchar(100) not null,
    f_nacimiento date,
    email varchar(50),
    id_rol int,
    CONSTRAINT FOREIGN KEY fk_usario_rol (id_rol) REFERENCES rol(id_rol)
);

CREATE TABLE rol(
    id_rol int primary key auto_increment,
    tipo varchar(10) not null
);

CREATE TABLE tipoClase(
    id_clase int primary key auto_increment,
    nombre varchar(50) not null,
    descripcion varchar(200),
    activo boolean
);

CREATE TABLE clase(
    id_claseC int primary key auto_increment, 
    activo boolean,
    sala varchar(50) not null,
    f_inicio datetime,
    f_fin datetime,
    plazas int,
    plazas_ocupadas int,
    id_clase int,
    id_user int,
    CONSTRAINT FOREIGN KEY fk_tipoClase_clase (id_clase) REFERENCES tipoClase(id_clase),
    CONSTRAINT FOREIGN KEY fk_user_clase (id_user) REFERENCES usuario(id_user)
);

CREATE TABLE asiste(
    id_asiste int primary key auto_increment,
  id_clase int,
    id_user int,
    clasificacion float,
    activo boolean,
    CONSTRAINT FOREIGN KEY fk_tipoClase_asiste (id_clase) REFERENCES tipoClase(id_clase),
    CONSTRAINT FOREIGN KEY fk_user_asiste (id_user) REFERENCES usuario(id_user)   
);

CREATE TABLE acude(
    id_acude int primary key auto_increment,
    id_user int,
    id_evento int,
    activo boolean,
    CONSTRAINT FOREIGN KEY fk_user_acude(id_user) REFERENCES usuario(id_user),
    CONSTRAINT FOREIGN KEY fk_evento_acude(id_evento) REFERENCES evento(id_evento) 
);

CREATE TABLE evento(
    id_evento int primary key auto_increment,
    f_inicio datetime,
    f_fin datetime,
    plazas int,
    plazas_ocupadas int,
    nombre varchar(50),
    descripcion varchar(200),
    activo boolean,
    id_user int,
    CONSTRAINT FOREIGN KEY fk_user_evento (id_user) REFERENCES usuario(id_user)   
);

CREATE TABLE rutina(
    id_rutina int primary key auto_increment,
    activo boolean,
    descripcion varchar(200),
    nombre varchar(50),
    f_inicio datetime,
    f_fin datetime,
    id_user int,
    CONSTRAINT FOREIGN KEY fk_user_rutina (id_user) REFERENCES usuario(id_user)   
);

CREATE TABLE contiene(
    repetir int,
    kg float,
    id_rutina int,
    id_ejercicio int,
    CONSTRAINT FOREIGN KEY fk_rutina_contiene (id_rutina) REFERENCES rutina(id_rutina),
    CONSTRAINT FOREIGN KEY fk_ejercicio_contiene (id_ejercicio) REFERENCES ejercicio(id_ejercicio)
);

CREATE TABLE ejercicio(
    id_ejercicio int primary key auto_increment,
    activo boolean,
    video varchar(50)
);
