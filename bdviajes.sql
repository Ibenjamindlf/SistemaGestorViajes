-- bdviajes.sql Validado
CREATE DATABASE bdviajes; 
USE bdviajes;

CREATE TABLE empresa (
    idEmpresa bigint AUTO_INCREMENT,
    nombre varchar (150),
    direccion varchar (150),
    PRIMARY KEY (idEmpresa)
    ) 
ENGINE = InnoDB DEFAULT CHARSET = utf8 AUTO_INCREMENT = 1;

CREATE TABLE responsable (
    numeroEmpleado bigint AUTO_INCREMENT,
    numeroLicencia bigint,
	nombre varchar (150), 
    apellido  varchar (150), 
    PRIMARY KEY (numeroEmpleado)
    )
ENGINE = InnoDB DEFAULT CHARSET = utf8 AUTO_INCREMENT = 1;

CREATE TABLE viaje (
    idViaje bigint AUTO_INCREMENT, 
	destino varchar (150),
    cantMaxPasajeros int,
	idEmpresa bigint,
    numeroEmpleado bigint,
    importe float,
    PRIMARY KEY (idViaje),
    FOREIGN KEY (idEmpresa) REFERENCES empresa (idEmpresa)
    ON UPDATE RESTRICT
    ON DELETE RESTRICT,
	FOREIGN KEY (numeroEmpleado) REFERENCES responsable (numeroEmpleado)
    ON UPDATE RESTRICT
    ON DELETE RESTRICT
    ) 
ENGINE = InnoDB DEFAULT CHARSET = utf8 AUTO_INCREMENT = 1;

CREATE TABLE pasajero (
    numeroDocumento varchar (15),
    nombre varchar (150), 
    apellido varchar (150), 
	telefono int, 
	idViaje bigint,
    PRIMARY KEY (numeroDocumento),
	FOREIGN KEY (idViaje) REFERENCES viaje (idViaje)
    ON UPDATE RESTRICT
    ON DELETE RESTRICT
    )
ENGINE = InnoDB DEFAULT CHARSET = utf8;