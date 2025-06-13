-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 09, 2025 at 03:48 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bzberlin`
--
CREATE DATABASE IF NOT EXISTS `bzberlin` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `bzberlin`;

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

CREATE TABLE `korisnik` (
  `id` int(11) NOT NULL,
  `ime` varchar(32) NOT NULL,
  `prezime` varchar(32) NOT NULL,
  `korisnicko_ime` varchar(32) NOT NULL,
  `lozinka` varchar(255) NOT NULL,
  `razina` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`id`, `ime`, `prezime`, `korisnicko_ime`, `lozinka`, `razina`) VALUES
(1, 'Ivan', 'Horvat', 'ivanhorvat', '$2y$10$SFqc3tsLRnI71TOAntIGoO6z0sqXPYeJv6/CyLHgXwrPcdwN17H4G', 0),
(2, 'Admin', 'Admin', 'admin', '$2y$10$YJmDfV0PWeHT8ENu4xr.hO8yaM5PfUnUd/9SXWSk8aWrLRc6jBAy2', 1),
(3, 'Leo', 'Stričak', 'leo', '$2y$10$i2p/Xm1d4GZkSMBS9zVecO9j/XZG7kicDjXfQ0B7/bbntD5NpEpge', 1),
(4, 'Mateo', 'Spevec', 'mspevec', '$2y$10$b1ga8eL3bXPqa/gihc1hyevh.zMPduhl1C4vTMfnfRY96zy4MCXwW', 1),
(5, 'Laura', 'Završki', 'laura', '$2y$10$Mr9BnKEscg2BzMgXWE.VFuVLlj0FYvCWPK6Nklr9QruNHAGBWDgla', 1),
(6, 'Julia', 'Janković', 'julia', '$2y$10$70GMpctkB.f3TOrlGbov7ekBR8iMOukU1EWciJlMXsTkFKUVhPG2O', 1),
(7, 'Igor', 'Belan', 'ibelan', '$2y$10$GKyi2L1a9tl6Q8IdoA.E6.irt9HGrXyvnwNp3w5mZ.6ycW6btVoKa', 0),
(8, 'Matija', 'Prodan', 'matija', '$2y$10$HHG16J4LC1knrqWxrJnlIuUOGc8KeQbGFkojiQBGwgpNqWu2RZO9e', 0);

-- --------------------------------------------------------

--
-- Table structure for table `vijesti`
--

CREATE TABLE `vijesti` (
  `id` int(11) NOT NULL,
  `datum` varchar(32) CHARACTER SET utf8 COLLATE utf8_croatian_ci NOT NULL,
  `naslov` varchar(64) CHARACTER SET latin2 COLLATE latin2_croatian_ci NOT NULL,
  `sazetak` text CHARACTER SET latin2 COLLATE latin2_croatian_ci NOT NULL,
  `tekst` text CHARACTER SET latin2 COLLATE latin2_croatian_ci NOT NULL,
  `slika` varchar(64) CHARACTER SET latin2 COLLATE latin2_croatian_ci NOT NULL,
  `kategorija` varchar(64) CHARACTER SET latin2 COLLATE latin2_croatian_ci NOT NULL,
  `arhiva` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `vijesti`
--

INSERT INTO `vijesti` (`id`, `datum`, `naslov`, `sazetak`, `tekst`, `slika`, `kategorija`, `arhiva`) VALUES
(1, '9.6.2025.', 'Hrvatska pobijedila u finalu', 'Nevjerojatna utakmica u kojoj je Hrvatska osvojila zlato.', 'Hrvatska je odigrala fantastično.\r\n\r\nU drugom poluvremenu su dominirali i zasluženo pobijedili.\r\n\r\nPublika je bila oduševljena prikazanom igrom.\r\n\r\nAnalitičari smatraju da je ovo najjača generacija dosad.\r\n\r\nSlavlje u cijeloj zemlji potrajalo je do kasno u noć.', 'reprezentacija.jpg', 'Sport', 0),
(2, '8.6.2025.', 'Otvorenje ljetnog festivala', 'Festival kulture započeo svečanom ceremonijom u Zagrebu.', 'U srcu Zagreba održano je otvorenje festivala.\r\n\r\nSudjelovalo je više od 100 izvođača iz cijelog svijeta.\r\n\r\nProgram je uključivao plesne nastupe, kazališne predstave i radionice.\r\n\r\nGrađani su s oduševljenjem pozdravili bogatu kulturnu ponudu.\r\n\r\nOčekuje se više od 50.000 posjetitelja tijekom tjedna.', 'festival.jpg', 'Kultura', 0),
(3, '7.6.2025.', 'Novi stadion u Splitu', 'Split dobiva ultramoderan stadion do kraja godine.', 'Grad Split predstavio je projekt novog stadiona.\r\n\r\nKapacitet će biti 35.000 gledatelja, a stadion će zadovoljiti UEFA standarde.\r\n\r\nUz to, stadion će imati dodatne sadržaje poput muzeja i restorana.\r\n\r\nNavijači su izrazili veliko zadovoljstvo ovim najavama.\r\n\r\nGradonačelnik je naglasio važnost sporta za zajednicu.', 'stadion.jpg', 'Sport', 0),
(4, '6.6.2025.', 'Izložba suvremene umjetnosti', 'U MSU-u otvorena nova izložba mladih umjetnika.', 'Izložba prikazuje radove 20 domaćih i stranih umjetnika.\r\n\r\nPosjetitelji su oduševljeni interaktivnim instalacijama.\r\n\r\nDogađaj je dio šireg ciklusa kulturnih aktivnosti u MSU-u.\r\n\r\nMnogi su istaknuli inovativnost i društvenu kritiku radova.\r\n\r\nIzložba traje do kraja mjeseca i besplatna je za studente.', 'suvremena-umjetnost.jpg', 'Kultura', 1),
(5, '5.6.2025.', 'Pobjeda mladih tenisača', 'Mladi hrvatski tenisači briljirali na europskom prvenstvu.', 'U finalu su savladali jake protivnike iz Francuske.\r\n\r\nOvo je veliki uspjeh za hrvatski sport.\r\n\r\nTrener je pohvalio trud i disciplinu cijelog tima.\r\n\r\nMladi igrači izrazili su zahvalnost svojim obiteljima i školama.\r\n\r\nMinistar sporta najavio je dodatna ulaganja u mlade sportaše.', 'borna-coric.jpg', 'Sport', 0),
(6, '4.6.2025.', 'Vatreni najavili pripreme za Euro', 'Reprezentacija kreće s pripremama u Rovinju.', 'Reprezentacija Hrvatske okupila se danas u Rovinju gdje će provesti idućih deset dana priprema za nadolazeće Europsko prvenstvo.\r\n\r\nIzbornik je izrazio zadovoljstvo formom igrača te dodao kako je atmosfera u svlačionici odlična. \r\n\r\nUtakmice protiv Njemačke i Italije poslužit će kao ključni testovi.\r\n\r\nStručni stožer najavio je intenzivan raspored treninga.\r\n\r\nNavijači s nestrpljenjem očekuju prve pripremne nastupe.', 'vatreni.jpg', 'Sport', 0),
(7, '3.6.2025.', 'Noć muzeja ponovno ruši rekorde', 'Tisuće građana sudjelovalo u kulturnoj manifestaciji.', 'Ovogodišnja Noć muzeja privukla je više od 120.000 posjetitelja diljem Hrvatske.\r\n\r\nPosebno su bile popularne tematske izložbe o digitalnoj umjetnosti i hrvatskoj povijesti.\r\n\r\nZagrebački Muzej suvremene umjetnosti zabilježio je rekordnu posjećenost s preko 15.000 ljudi u jednoj noći.\r\n\r\nOrganizatori ističu važnost dostupne kulture za sve građane.\r\n\r\nPlanira se širenje programa na manje gradove iduće godine.', 'noc-muzeja.jpg', 'Kultura', 0),
(8, '2.6.2025.', 'Mladi inovatori briljirali u Bruxellesu', 'Hrvatski studenti osvojili prva mjesta na europskom sajmu inovacija.', 'Tim studenata s Tehničkog veleučilišta Zagreb predstavio je pametnu solarnu klupu koja mjeri zagađenje zraka i ima ugrađen sustav za bežično punjenje mobitela.\r\n\r\nProjekt je osvojio prvo mjesto među više od 80 prijavljenih inovacija iz 23 zemlje.\r\n\r\nMentori su naglasili važnost ulaganja u mlade inovatore.\r\n\r\nOva nagrada otvara vrata međunarodnim suradnjama.\r\n\r\nPlanira se i serijska proizvodnja uređaja u Hrvatskoj.', 'inovatori.jpg', 'Kultura', 0),
(9, '1.6.2025.', 'Dinamovci započeli novu sezonu s pobjedom', 'Dinamo nadigrao Rijeku s 3:1 u Maksimiru.', 'Utakmica je obilježena visokim intenzitetom i brojnim prilikama s obje strane.\r\n\r\nDinamov napadač postigao je hat-trick i proglašen je igračem utakmice.\r\n\r\nTrener Dinama rekao je nakon susreta da je ovo bila zaslužena pobjeda i najavio borbu za naslov.\r\n\r\nTribine su bile gotovo ispunjene, a atmosfera sjajna.\r\n\r\nNavijači su poručili da očekuju trofeje ove sezone.', 'dinamo.jpg', 'Sport', 0),
(10, '31.5.2025.', 'Kazališna premijera izazvala ovacije', 'Nova predstava \"Sjaj tame\" premijerno izvedena u HNK-u.', 'Predstava \"Sjaj tame\", režirana od strane nagrađivanog redatelja Marka Vrdoljaka, donosi snažnu poruku o društvenim podjelama i ljudskoj empatiji.\r\n\r\nPublika je gromoglasnim pljeskom pozdravila glumačku postavu.\r\n\r\nKritičari hvale originalnost i emotivnu dubinu izvedbe.\r\n\r\nPredstava će igrati tijekom lipnja i srpnja.\r\n\r\nUlaznice su već rasprodane za prvih pet izvedbi.', 'kazaliste.jpg', 'Kultura', 1),
(11, '30.5.2025.', 'Trčanje za zdravlje u Parku Maksimir', 'Održana humanitarna utrka s više od 5.000 sudionika.', 'Pod geslom \"Zdrav duh u zdravom tijelu\", u Zagrebu je održana već tradicionalna utrka čiji je prihod namijenjen udruzi za pomoć djeci oboljeloj od dijabetesa.\r\n\r\nDogađaj je uključivao i radionice, nastupe lokalnih bendova te edukativne sadržaje za sve uzraste.\r\n\r\nSudionici su trčali stazom dugom 5 kilometara kroz prirodu.\r\n\r\nAtmosfera je bila vesela, a svi su natjecatelji dobili majice i medalje.\r\n\r\nOrganizatori najavljuju još veći odaziv iduće godine.', 'trcanje.jpg', 'Sport', 0),
(12, '29.5.2025.', 'Jazz večer u centru grada', 'Večer jazza okupila brojne zaljubljenike u glazbu.', 'Na glavnom zagrebačkom trgu održan je koncert poznatog jazz benda iz Nizozemske.\r\n\r\nPublika je uživala u trosatnom nastupu pod vedrim nebom.\r\n\r\nU sklopu događanja organizirani su i besplatni plesni tečajevi.\r\n\r\nBrojni prolaznici spontano su se priključili slavlju.\r\n\r\nGrad Zagreb planira više sličnih večeri tijekom ljeta.', 'jazz.jpg', 'Kultura', 0),
(13, '28.5.2025.', 'Sportski dan osnovnih škola', 'Djeca iz cijele regije sudjelovala u natjecanjima.', 'Održano je više od 20 različitih sportskih disciplina, a cilj događaja bio je promicanje aktivnog načina života kod djece.\r\n\r\nRoditelji i učitelji su iskazali veliko zadovoljstvo organizacijom.\r\n\r\nNajviše interesa izazvala su natjecanja u nogometu i atletici.\r\n\r\nDječji osmjesi i navijanje ispunili su sportske terene.\r\n\r\nPobjednici su nagrađeni medaljama i poklon paketima.', 'sportski-dani.jpg', 'Sport', 0),
(14, '27.5.2025.', 'Zatvorena retrospektiva suvremene fotografije', 'U Galeriji Kranjčar završila velika izložba fotografije.', 'Iako su organizatori očekivali 2.000 posjetitelja, izložbu je tijekom tri tjedna razgledalo preko 6.500 ljudi.\r\n\r\nTematski fokus bio je na urbanom životu i društvenim kontrastima.\r\n\r\nFotografije su prikazivale svakodnevicu iz neočekivanih perspektiva.\r\n\r\nIzložba je posebno privukla mladu publiku i fotografske entuzijaste.\r\n\r\nPlanira se izdavanje kataloga s najzapaženijim radovima.', 'retrospektiva.jpg', 'Kultura', 1),
(15, '26.5.2025.', 'Atletski miting u Osijeku oduševio publiku', 'Više od 300 natjecatelja iz regije sudjelovalo na međunarodnom mitingu.', 'Miting je okupio atletičare iz 10 zemalja, a najviše ovacija dobili su hrvatski predstavnici koji su oborili osobne rekorde.\r\n\r\nOvaj događaj sve više raste iz godine u godinu.\r\n\r\nTribine su bile ispunjene sportskim entuzijastima svih uzrasta.\r\n\r\nNatjecanja su se odvijala u disciplini sprinta, skoka u dalj i bacanja kugle.\r\n\r\nOrganizatori najavljuju kandidaturu za domaćinstvo europskog prvenstva.', 'atletika.jpg', 'Sport', 0),
(16, '25.5.2025.', 'Ljetno kino na otvorenom', 'Besplatne projekcije filmova pod zvjezdanim nebom.', 'Na jezeru Bundek započeo je program ljetnog kina koji će trajati do kraja kolovoza.\r\n\r\nSvake večeri prikazuju se filmski klasici, uz popratne glazbene programe i štandove s hranom.\r\n\r\nPublika sjedi na dekama i ležaljkama, stvarajući opuštenu atmosferu.\r\n\r\nFilmovi se biraju putem online glasovanja građana.\r\n\r\nOva manifestacija svake godine privlači tisuće posjetitelja svih generacija.', 'kino.jpg', 'Kultura', 0),
(17, '24.5.2025.', 'Nogometna legenda završila karijeru', 'Emotivni oproštaj dugogodišnjeg reprezentativca Hrvatske.', 'Na stadionu u Zagrebu, u prisustvu tisuća navijača i bivših suigrača, poznati nogometaš održao je oproštajnu utakmicu.\r\n\r\nUz suze i ovacije, zahvalio se obitelji, klubu i navijačima na nezaboravnoj karijeri.\r\n\r\nTijekom 15 godina nastupa za reprezentaciju, ostavio je neizbrisiv trag.\r\n\r\nPredsjednik saveza uručio mu je posebno priznanje za doprinos sportu.\r\n\r\nIako završava karijeru, najavio je ostanak u nogometu kao trener.', 'mandzukic.jpg', 'Sport', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `korisnicko_ime` (`korisnicko_ime`);

--
-- Indexes for table `vijesti`
--
ALTER TABLE `vijesti`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `korisnik`
--
ALTER TABLE `korisnik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `vijesti`
--
ALTER TABLE `vijesti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
