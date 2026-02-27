-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 27, 2026 at 12:06 PM
-- Server version: 8.4.3
-- PHP Version: 8.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ccc-phi_bdd`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(1024) NOT NULL,
  `date` date NOT NULL,
  `content` text NOT NULL,
  `image_url` varchar(1024) DEFAULT NULL,
  `id_user` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `title`, `slug`, `date`, `content`, `image_url`, `id_user`) VALUES
(1, 'Comment faire un don de matériel médical ?', 'comment-faire-un-don-de-materiel-medical', '2026-02-26', '<p>Le don de mat&eacute;riel m&eacute;dical est un geste solidaire &agrave; fort impact social et environnemental. Chaque ann&eacute;e, des milliers d&rsquo;&eacute;quipements m&eacute;dicaux encore fonctionnels sont stock&eacute;s, remplac&eacute;s ou jet&eacute;s, alors qu&rsquo;ils pourraient am&eacute;liorer concr&egrave;tement la vie de personnes en situation de fragilit&eacute;.</p>\r\n<p>Que vous soyez un particulier, un professionnel de sant&eacute; ou un &eacute;tablissement m&eacute;dical, donner votre &eacute;quipement non utilis&eacute; est une d&eacute;marche simple, responsable et utile.</p>\r\n<p>D&eacute;couvrez comment faire un don de mat&eacute;riel m&eacute;dical, quels &eacute;quipements sont concern&eacute;s et pourquoi passer par l&rsquo;association PHI.</p>\r\n<h2>Pourquoi faire un don de mat&eacute;riel m&eacute;dical ?</h2>\r\n<p>Le don de mat&eacute;riel m&eacute;dical pr&eacute;sente plusieurs avantages :</p>\r\n<ul>\r\n<li>Prolonger la dur&eacute;e de vie d&rsquo;&eacute;quipements encore utilisables</li>\r\n<li>Aider des professionnels et des patients en difficult&eacute; financi&egrave;re</li>\r\n<li>R&eacute;duire le gaspillage et l&rsquo;impact environnemental</li>\r\n<li>Soutenir des actions solidaires concr&egrave;tes</li>\r\n</ul>\r\n<p>Beaucoup de mat&eacute;riel m&eacute;dical d&rsquo;occasion reste inutilis&eacute; apr&egrave;s une hospitalisation, un renouvellement d&rsquo;&eacute;quipement ou la fermeture d&rsquo;un cabinet. Pourtant, ces dispositifs peuvent &ecirc;tre essentiels pour d&rsquo;autres personnes ou structures.</p>\r\n<h2>Quel mat&eacute;riel m&eacute;dical peut &ecirc;tre donn&eacute; ?</h2>\r\n<p>Le don de mat&eacute;riel m&eacute;dical peut concerner diff&eacute;rents types d&rsquo;&eacute;quipements, selon leur &eacute;tat et leur fonctionnalit&eacute;.</p>\r\n<h3>Mat&eacute;riel collect&eacute;</h3>\r\n<p>Divers &eacute;quipements m&eacute;dicaux peuvent &ecirc;tre remis en &eacute;tat et r&eacute;utilis&eacute;s, notamment :</p>\r\n<ul>\r\n<li>Les fauteuils roulants</li>\r\n<li>Les b&eacute;quilles et d&eacute;ambulateurs</li>\r\n<li>Les lits m&eacute;dicalis&eacute;s</li>\r\n<li>Les cannes et aides &agrave; la mobilit&eacute;</li>\r\n<li>Le mat&eacute;riel de maintien &agrave; domicile</li>\r\n<li>Les compresses, pansements et bandages</li>\r\n</ul>\r\n<p>M&ecirc;me si votre mat&eacute;riel est consid&eacute;r&eacute; comme obsol&egrave;te, il peut rester pleinement fonctionnel dans un autre contexte. Le mat&eacute;riel m&eacute;dical d&rsquo;occasion &agrave; donner doit simplement &ecirc;tre en bon &eacute;tat, propre et, si possible, complet.</p>\r\n<h2>Pourquoi passer par l&rsquo;association PHI ?</h2>\r\n<p>Pour que votre don de mat&eacute;riel m&eacute;dical soit r&eacute;ellement utile et s&eacute;curis&eacute;, il est essentiel de passer par une structure sp&eacute;cialis&eacute;e.</p>\r\n<p>L&rsquo;association PHI collecte, v&eacute;rifie, remet en &eacute;tat lorsque cela est possible et redistribue le mat&eacute;riel m&eacute;dical aupr&egrave;s de b&eacute;n&eacute;ficiaires qui en ont r&eacute;ellement besoin.</p>\r\n<p>En choisissant PHI, vous b&eacute;n&eacute;ficiez :</p>\r\n<ul>\r\n<li>D&rsquo;une &eacute;valuation du mat&eacute;riel</li>\r\n<li>D&rsquo;un tri rigoureux</li>\r\n<li>D&rsquo;une logistique organis&eacute;e</li>\r\n<li>D&rsquo;une redistribution responsable</li>\r\n<li>D&rsquo;une d&eacute;marche transparente</li>\r\n</ul>\r\n<p>PHI agit comme interm&eacute;diaire de confiance entre les donateurs et les b&eacute;n&eacute;ficiaires.</p>\r\n<h2>Comment faire un don de mat&eacute;riel m&eacute;dical avec PHI ?</h2>\r\n<p>La d&eacute;marche est simple et structur&eacute;e.</p>\r\n<h3>1. Identifier le mat&eacute;riel disponible</h3>\r\n<p>Faites l&rsquo;inventaire du mat&eacute;riel m&eacute;dical d&rsquo;occasion &agrave; donner : type d&rsquo;&eacute;quipement, &eacute;tat g&eacute;n&eacute;ral, accessoires fournis.</p>\r\n<h3>2. Contacter PHI</h3>\r\n<p>Transmettez la liste du mat&eacute;riel, accompagn&eacute;e si possible de photos. L&rsquo;&eacute;quipe &eacute;tudie la demande et confirme si le mat&eacute;riel peut &ecirc;tre pris en charge.</p>\r\n<h3>3. Organisation de la collecte ou du d&eacute;p&ocirc;t</h3>\r\n<p>Selon le volume et la localisation, PHI organise un d&eacute;p&ocirc;t ou une collecte. Contactez l&rsquo;association la plus proche de chez vous pour en savoir plus.</p>\r\n<p>[Bouton : Trouver l&rsquo;association PHI pr&egrave;s de chez moi]</p>\r\n<h3>4. V&eacute;rification et redistribution</h3>\r\n<p>Le mat&eacute;riel est contr&ocirc;l&eacute;, nettoy&eacute; et, si n&eacute;cessaire, remis en &eacute;tat avant d&rsquo;&ecirc;tre redistribu&eacute;.</p>\r\n<h2>Professionnels de sant&eacute; : valorisez votre mat&eacute;riel obsol&egrave;te</h2>\r\n<p>Cabinets m&eacute;dicaux, cliniques, h&ocirc;pitaux, EHPAD : lors d&rsquo;un renouvellement d&rsquo;&eacute;quipement, le mat&eacute;riel remplac&eacute; peut encore servir.</p>\r\n<p>Le don de mat&eacute;riel m&eacute;dical permet :</p>\r\n<ul>\r\n<li>De r&eacute;duire les co&ucirc;ts de stockage</li>\r\n<li>D&rsquo;inscrire votre structure dans une d&eacute;marche de responsabilit&eacute; soci&eacute;tale</li>\r\n<li>De limiter le gaspillage</li>\r\n<li>De soutenir une action solidaire concr&egrave;te</li>\r\n</ul>\r\n<p>PHI accompagne les &eacute;tablissements dans une d&eacute;marche organis&eacute;e et adapt&eacute;e aux contraintes professionnelles.</p>\r\n<h2>Particuliers : un geste simple et utile</h2>\r\n<p>Apr&egrave;s une hospitalisation ou le d&eacute;c&egrave;s d&rsquo;un proche, il reste souvent du mat&eacute;riel m&eacute;dical inutilis&eacute;.</p>\r\n<p>Plut&ocirc;t que de le stocker ou de le jeter, le don de mat&eacute;riel m&eacute;dical permet de lui offrir une seconde vie. Un fauteuil roulant, un lit m&eacute;dicalis&eacute; ou un d&eacute;ambulateur peut transformer le quotidien d&rsquo;une autre famille.</p>\r\n<p>Un geste solidaire et responsable.</p>\r\n<p>Le don de mat&eacute;riel m&eacute;dical s&rsquo;inscrit dans une logique d&rsquo;&eacute;conomie circulaire et de solidarit&eacute;. Chaque &eacute;quipement r&eacute;utilis&eacute; &eacute;vite un gaspillage inutile et contribue &agrave; am&eacute;liorer l&rsquo;acc&egrave;s aux soins ou le maintien &agrave; domicile.</p>\r\n<p>Donner son mat&eacute;riel m&eacute;dical, c&rsquo;est transformer un &eacute;quipement inutilis&eacute; en solution concr&egrave;te pour quelqu&rsquo;un d&rsquo;autre.</p>\r\n<h2>Faites un don d&egrave;s aujourd&rsquo;hui</h2>\r\n<p>Vous disposez de mat&eacute;riel m&eacute;dical d&rsquo;occasion &agrave; donner ? L&rsquo;association PHI est pr&ecirc;te &agrave; l&rsquo;&eacute;valuer et &agrave; lui offrir une seconde vie utile et solidaire.</p>\r\n<p>Contactez-nous pour participer &agrave; une action concr&egrave;te au service des personnes qui en ont besoin.</p>', '', 1),
(2, 'Tour de France PHI 2025-2026 : former et structurer les associations locales', 'tour-de-france-phi-2025-2026-former-et-structurer-les-associations-locales', '2026-02-26', '<p>En 2025-2026, Pharmacie Humanitaire Internationale (PHI) lance un Tour de France d&eacute;di&eacute; &agrave; la formation des associations locales de son r&eacute;seau. Cette initiative nationale vise &agrave; renforcer les comp&eacute;tences des b&eacute;n&eacute;voles, professionnaliser les pratiques associatives et consolider l&rsquo;efficacit&eacute; des actions humanitaires men&eacute;es sur le terrain.</p>\r\n<p>Ce programme de formation itin&eacute;rant r&eacute;pond &agrave; un besoin clairement identifi&eacute; lors du congr&egrave;s national de PHI : accompagner durablement les structures locales pour garantir une gestion rigoureuse, une communication efficace et des missions solidaires mieux coordonn&eacute;es.</p>\r\n<h2>Un programme de formation pour renforcer les associations locales</h2>\r\n<p>Le Tour de France PHI s&rsquo;inscrit dans une d&eacute;marche de structuration du r&eacute;seau associatif. L&rsquo;objectif est triple :</p>\r\n<ul>\r\n<li>D&eacute;velopper les comp&eacute;tences administratives et financi&egrave;res des dirigeants associatifs</li>\r\n<li>Harmoniser les pratiques au sein du r&eacute;seau PHI</li>\r\n<li>Favoriser la coop&eacute;ration entre associations locales</li>\r\n</ul>\r\n<p>En investissant dans la formation des b&eacute;n&eacute;voles, PHI consolide son mod&egrave;le associatif et assure la p&eacute;rennit&eacute; de ses actions humanitaires en France et &agrave; l&rsquo;international.</p>\r\n<h2>Quatre modules cl&eacute;s pour professionnaliser le r&eacute;seau PHI</h2>\r\n<p>Le programme de formation repose sur quatre modules strat&eacute;giques, con&ccedil;us pour r&eacute;pondre aux enjeux concrets des associations locales :</p>\r\n<h3>Pilotage administratif d&rsquo;une association</h3>\r\n<p>Ma&icirc;triser les obligations l&eacute;gales, organiser la gouvernance et structurer le fonctionnement interne.</p>\r\n<h3>Gestion financi&egrave;re et comptable</h3>\r\n<p>Mettre en place une gestion budg&eacute;taire rigoureuse, assurer la transparence financi&egrave;re et s&eacute;curiser les ressources.</p>\r\n<h3>Communication associative</h3>\r\n<p>D&eacute;velopper la visibilit&eacute; locale, valoriser les actions men&eacute;es et renforcer l&rsquo;engagement des b&eacute;n&eacute;voles et partenaires.</p>\r\n<h3>Organisation des actions et missions humanitaires</h3>\r\n<p>Optimiser la coordination des projets solidaires et am&eacute;liorer l&rsquo;impact des interventions. Ces modules permettent aux associations locales PHI d&rsquo;acqu&eacute;rir des outils concrets et directement applicables dans leur fonctionnement quotidien.</p>\r\n<h2>Une tourn&eacute;e nationale au plus pr&egrave;s des territoires</h2>\r\n<p>Le format itin&eacute;rant du Tour de France favorise les &eacute;changes de terrain et la dynamique collective. En organisant les formations directement en r&eacute;gion, PHI facilite l&rsquo;acc&egrave;s &agrave; la formation pour les b&eacute;n&eacute;voles et renforce la coh&eacute;sion du r&eacute;seau.</p>\r\n<p>Depuis son lancement en octobre 2025, plusieurs &eacute;tapes ont d&eacute;j&agrave; r&eacute;uni de nombreuses associations locales :</p>\r\n<ul>\r\n<li>Lyon : octobre 2025</li>\r\n<li>Rennes : d&eacute;cembre 2025</li>\r\n<li>Paris : janvier 2026</li>\r\n</ul>\r\n<p>Chaque session a permis de partager des exp&eacute;riences, mutualiser les bonnes pratiques et renforcer les liens entre les diff&eacute;rentes structures du r&eacute;seau.</p>\r\n<h2>Prochaines &eacute;tapes du Tour de France PHI 2026</h2>\r\n<p>La tourn&eacute;e se poursuivra :</p>\r\n<ul>\r\n<li>Fin mars 2026 &agrave; Niort, &agrave; l&rsquo;occasion du congr&egrave;s national PHI</li>\r\n<li>Puis dans le Sud de la France pour cl&ocirc;turer ce cycle de formation</li>\r\n</ul>\r\n<p>Ce d&eacute;ploiement national confirme la volont&eacute; de PHI d&rsquo;accompagner durablement ses associations locales et d&rsquo;investir dans le d&eacute;veloppement des comp&eacute;tences associatives.</p>\r\n<h2>Un levier strat&eacute;gique pour l&rsquo;avenir du r&eacute;seau humanitaire</h2>\r\n<p>&Agrave; travers ce Tour de France, Pharmacie Humanitaire Internationale affirme son engagement en faveur d&rsquo;un r&eacute;seau structur&eacute;, comp&eacute;tent et solidaire. La formation des b&eacute;n&eacute;voles constitue un levier essentiel pour renforcer l&rsquo;impact des actions humanitaires et garantir une gestion associative responsable.</p>\r\n<p>En 2025-2026, PHI fait le choix d&rsquo;un accompagnement de proximit&eacute; pour consolider son maillage territorial et pr&eacute;parer l&rsquo;avenir de ses missions solidaires.</p>', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `mobilizations`
--

CREATE TABLE `mobilizations` (
  `id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(1024) NOT NULL,
  `description` text,
  `image_url` varchar(1024) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `image_url` varchar(1024) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `podcasts`
--

CREATE TABLE `podcasts` (
  `id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(1024) NOT NULL,
  `date` date NOT NULL,
  `path` varchar(1024) NOT NULL,
  `description` text,
  `author` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL COMMENT 'Identifiant de l’utilisateur',
  `login` varchar(150) NOT NULL COMMENT 'Nom d’utilisateur',
  `password` varchar(255) NOT NULL COMMENT 'Mot de passe',
  `email` varchar(150) NOT NULL COMMENT 'Adresse email',
  `role` enum('admin','editor') NOT NULL DEFAULT 'editor' COMMENT 'Rôle de l’utilisateur'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `email`, `role`) VALUES
(1, 'administrator', '$2y$10$dyTg5I.HQifga./trNG8ZOANaUPnyR3mj1c832VIfXh6K6Cr8v1YS', 'admin@phi.local', 'admin'),
(2, 'editor', '$2y$10$nVXfLydmCIiQ1qq9C20LoebIDG2BvKXXENwCAvwLD3zuSZroLxy/W', 'editor@phi.local', 'editor');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `mobilizations`
--
ALTER TABLE `mobilizations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `podcasts`
--
ALTER TABLE `podcasts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `mobilizations`
--
ALTER TABLE `mobilizations`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `podcasts`
--
ALTER TABLE `podcasts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'Identifiant de l’utilisateur', AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `articles_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
