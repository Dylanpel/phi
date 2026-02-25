CREATE TABLE Users(
  id INT AUTO_INCREMENT COMMENT 'Identifiant de l’utilisateur',
  login VARCHAR(150) NOT NULL COMMENT 'Nom d’utilisateur',
  password VARCHAR(255) NOT NULL COMMENT 'Mot de passe',
  email VARCHAR(150) NOT NULL COMMENT 'Adresse email',
  role ENUM('admin', 'editor') NOT NULL DEFAULT 'editor' COMMENT 'Rôle de l’utilisateur',
  PRIMARY KEY(id),
  UNIQUE(login),
  UNIQUE(email)
);

INSERT INTO `users` (`id`, `login`, `password`, `email`, `role`) VALUES
(1, 'administrator', '$2y$10$dyTg5I.HQifga./trNG8ZOANaUPnyR3mj1c832VIfXh6K6Cr8v1YS', 'admin@phi.local', 'admin'),
(2, 'editor', '$2y$10$nVXfLydmCIiQ1qq9C20LoebIDG2BvKXXENwCAvwLD3zuSZroLxy/W', 'editor@phi.local', 'editor');
