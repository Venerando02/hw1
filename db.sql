create DATABASE hw1;
use hw1;

create table utenti
(
id integer primary key auto_increment,
nome varchar(255),
cognome varchar(255),
email varchar(255),
username varchar(255),
password varchar(255)
) Engine = InnoDB;

CREATE TABLE lettura 
(
    utente INTEGER,
    id_articolo INTEGER AUTO_INCREMENT,
    contenuto JSON,
    INDEX utente_idx (utente),
    FOREIGN KEY (utente) REFERENCES utenti(id),
    PRIMARY KEY (id_articolo)
) ENGINE=InnoDB;

CREATE TABLE giocatori_preferiti
(
utente INTEGER,
giocatore INTEGER PRIMARY KEY,
info_giocatore JSON,

INDEX utente_index (utente),
FOREIGN KEY (utente) REFERENCES utenti(id)
) ENGINE = InnoDB;

CREATE TABLE albums(
id VARCHAR(255) PRIMARY KEY,
nome VARCHAR(255),
artista VARCHAR(255),
immagine VARCHAR(255),
data_rilascio VARCHAR(255),
url VARCHAR(255)
) ENGINE = InnoDB;

CREATE TABLE LIKES(
utente INTEGER,
album VARCHAR(255),

INDEX utente_idx (utente),
INDEX album_idx (album),

FOREIGN KEY (utente) REFERENCES UTENTI(id),
FOREIGN KEY (album) REFERENCES ALBUMS(id),

PRIMARY KEY(utente, album)
) ENGINE = InnoDB;