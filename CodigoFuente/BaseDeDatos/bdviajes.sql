CREATE DATABASE bdviajesBranch; 
USE bdviajesBranch;
CREATE TABLE Persona(
    nombre VARCHAR(150),
    apellido VARCHAR(150),
    tipoDocumento VARCHAR(150),
    numeroDocumento VARCHAR(150),
    telefono BIGINT,
    PRIMARY KEY (tipoDocumento,numeroDocumento)
) ENGINE = InnoDB DEFAULT CHARSET = utf8;

CREATE TABLE Pasajero (
    tipoDocumento VARCHAR(150),
    numeroDocumento VARCHAR(150),
    nacionalidad VARCHAR(150),
    necesitaAsistencia BOOLEAN,
    PRIMARY KEY (tipoDocumento,numeroDocumento),
    FOREIGN KEY (tipoDocumento,numeroDocumento) REFERENCES Persona (tipoDocumento,numeroDocumento)
    ON UPDATE CASCADE
    ON DELETE CASCADE
) ENGINE = InnoDB DEFAULT CHARSET = utf8;

CREATE TABLE Responsable (
    tipoDocumento VARCHAR(150),
    numeroDocumento VARCHAR(150),
    numeroEmpleado BIGINT UNIQUE,
    legajo VARCHAR(150) UNIQUE,
    PRIMARY KEY (tipoDocumento,numeroDocumento),
    FOREIGN KEY (tipoDocumento,numeroDocumento) REFERENCES Persona (tipoDocumento,numeroDocumento)
    ON UPDATE CASCADE
    ON DELETE CASCADE
) ENGINE = InnoDB DEFAULT CHARSET = utf8;

CREATE TABLE Empresa (
    idEmpresa BIGINT AUTO_INCREMENT,
    nombre varchar (150),
    direccion varchar (150),
    PRIMARY KEY (idEmpresa)
    ) 
ENGINE = InnoDB DEFAULT CHARSET = utf8 AUTO_INCREMENT = 1;

CREATE TABLE Viaje (
    idViaje BIGINT AUTO_INCREMENT, 
	destino varchar (150),
    cantMaxPasajeros int,
	idEmpresa BIGINT,
    tipoDocumentoResponsable VARCHAR(150),
    numeroDocumentoResponsable VARCHAR(150),
    importe FLOAT,
    PRIMARY KEY (idViaje),
    FOREIGN KEY (idEmpresa) REFERENCES Empresa (idEmpresa)
    ON UPDATE RESTRICT
    ON DELETE RESTRICT,
	FOREIGN KEY (tipoDocumentoResponsable,numeroDocumentoResponsable) REFERENCES Responsable (tipoDocumento,numeroDocumento)
    ON UPDATE RESTRICT
    ON DELETE RESTRICT
    ) 
ENGINE = InnoDB DEFAULT CHARSET = utf8 AUTO_INCREMENT = 1;

CREATE TABLE Viaje_pasajero (
    tipoDocumentoPasajero VARCHAR(150),
    numeroDocumentoPasajero VARCHAR(150),
    idViaje BIGINT,
    PRIMARY KEY (tipoDocumentoPasajero, numeroDocumentoPasajero, idViaje),
    FOREIGN KEY (tipoDocumentoPasajero, numeroDocumentoPasajero)
        REFERENCES Pasajero (tipoDocumento,numeroDocumento)
        ON UPDATE RESTRICT
        ON DELETE RESTRICT,
    FOREIGN KEY (idViaje)
        REFERENCES Viaje (idViaje)
        ON UPDATE RESTRICT
        ON DELETE RESTRICT
) ENGINE = InnoDB DEFAULT CHARSET = utf8;

