CREATE TABLE users(
  id_user INT AUTO_INCREMENT,
  email VARCHAR(200) ,
  login VARCHAR(200) ,
  password VARCHAR(50) ,
  role VARCHAR(25) ,
  PRIMARY KEY(id_user)
);

CREATE TABLE actus(
  id_article INT AUTO_INCREMENT,
  titre VARCHAR(200) ,
  contenu TEXT,
  image_url VARCHAR(250) ,
  id_user INT NOT NULL,
  PRIMARY KEY(id_article),
  FOREIGN KEY(id_user) REFERENCES users(id_user)
);

CREATE TABLE Podcasts(
  id_podcast INT AUTO_INCREMENT,
  titre VARCHAR(50)  NOT NULL,
  date DATE NOT NULL,
  chemin VARCHAR(512) ,
  description TEXT,
  auteur VARCHAR(150) ,
  PRIMARY KEY(id_podcast)
);

CREATE TABLE pages(
  id_page INT AUTO_INCREMENT,
  titre VARCHAR(150)  NOT NULL,
  texte TEXT NOT NULL,
  image_url VARCHAR(150) ,
  PRIMARY KEY(id_page)
);

CREATE TABLE mobilisations(
  id_mobilisation INT AUTO_INCREMENT,
  titre VARCHAR(200) ,
  description TEXT,
  image_url VARCHAR(150) ,
  PRIMARY KEY(id_mobilisation)
);