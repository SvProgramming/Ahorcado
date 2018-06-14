drop database if exists PruebaAhorcado;

create database PruebaAhorcado;

use PruebaAhorcado;

create table Jugador(
usuario varchar(30) not null,
cantidadJuegos int,
contra varchar(256) not null,
puntajeMaximo int,
enLinea bool not null,
primary key pkJugador(usuario)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

create table Puntuacion(
idPuntuacion int auto_increment not null,
puntaje int not null,
usuario varchar(30) not null,
primary key pkPuntuacion(idPuntuacion),
foreign key fkPuntuacionXJugador(usuario) references Jugador(usuario)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

create table Palabra(
codigoPalabra int auto_increment not null,
texto varchar(25) not null,
reporte int,
pista varchar(35) not null,
primary key pkPalabra(codigoPalabra)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

create table JugadorXPalabra(
idJugadorXPalabra int auto_increment not null,
usuario varchar(30) not null,
codigoPalabra int not null,
primary key pkJugadorXpalabra(idJugadorXPalabra),
foreign key fkJugadorXPalabraXJugador(usuario) references Jugador(usuario),
foreign key fkJugadorXPalabraXPalabra(codigoPalabra) references Palabra(codigoPalabra)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;


create table UsuariosBuscandoPartida(
idBusqueda int auto_increment not null,
usuario varchar(30) not null,
usuarioEmparejado boolean not null,
contrincante varchar(30) null,
primary key pkUsuariosBuscandoPartida(idBusqueda)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Pruebas*/

insert into Palabra (texto,reporte,pista) values ("hola mundo",0,"la vieja confiable en progra");

insert into Jugador values ("ref98",1,'c0IoYL636FuVHDv05YaNhzo6AePhqK4LtpoLi4qN/ITFozo6JDJ5JDEyJGRzbVcvcm5sTndnTDFyTkFkNXlYeE92UnBPM2pyL0VaVTBSVFVJMGN3Qi9DL1ZyOUdsczl1',5000,0);

insert into Puntuacion(puntaje,usuario) values (5000,"ref98");

insert into JugadorXPalabra(usuario,codigoPalabra) values ("ref98",1);


/**selects, updates y deletes**/
/*Descomentar solo para utilizarlos*/
/*
select * from palabra;
select * from Jugador;
select * from Puntuacion;
select * from JugadorXPalabra;
select * from UsuariosBuscandoPartida;

SELECT * FROM Jugador where AES_DECRYPT(contra, 'hola') = "prueba" and usuario = "ref98";

select count(usuario) from UsuariosBuscandoPartida;

select usuario as 'usuarios' from UsuariosBuscandoPartida;


delete from UsuariosBuscandoPartida where Usuario="ref98";

select usuario from UsuariosBuscandoPartida where Usuario="ref98";

select * from UsuariosBuscandoPartida where usuario="ref98" and usuarioEmparejado=1;

update usuariosBuscandoPartida set usuarioEmparejado=1 where usuario="Usuario6";

*/