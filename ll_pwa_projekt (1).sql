-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Jun 21, 2026 at 08:42 PM
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
-- Database: `ll_pwa_projekt`
--
CREATE DATABASE IF NOT EXISTS `ll_pwa_projekt` DEFAULT CHARACTER SET utf16 COLLATE utf16_croatian_ci;
USE `ll_pwa_projekt`;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_croatian_ci;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`id`, `ime`, `prezime`, `korisnicko_ime`, `lozinka`, `razina`) VALUES
(1, 'Lana', 'Luketić', 'admin', '$2y$10$HNC/bHbxxJF3dfOWA4UJSunpjyLK4FrVeVhYnSZoO4jfKHEHiSRKO', 1),
(2, 'Ime', 'Prezime', 'korisnik1', '$2y$10$w.9Axz6x40E99F2rBZi0Fe13GXFMzZ5z9cvTcVWKDJ9LGkJopk5B.', 0),
(4, 'Ana', 'Prezime', 'korisnik2', '$2y$10$x/pnVyrpI3NEriNia/bFvef9rVMheUMA3xfGCHzgT1XNBQACMriEC', 0),
(5, 'Test', 'Test', 'test', '$2y$10$Npy8azv8rMdztqP9kxVS4OlqfHpWt6RdHmaZ2Xwcr4WrF6rTApMgq', 0);

-- --------------------------------------------------------

--
-- Table structure for table `vijesti`
--

CREATE TABLE `vijesti` (
  `id` int(11) NOT NULL,
  `naslov` varchar(255) NOT NULL,
  `sazetak` text NOT NULL,
  `tekst` text NOT NULL,
  `slika` varchar(255) NOT NULL,
  `kategorija` varchar(52) NOT NULL,
  `arhiva` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_croatian_ci;

--
-- Dumping data for table `vijesti`
--

INSERT INTO `vijesti` (`id`, `naslov`, `sazetak`, `tekst`, `slika`, `kategorija`, `arhiva`) VALUES
(1, 'Otrovna riba sve se brže širi grčkim morem', 'Stručnjaci upozoravaju da se srebrnoprugi napuhač širi prema novim područjima u Grčkoj te predstavlja rizik za ribarstvo, ekosustav i ljude', 'Srebrnoprugi napuhač, invazivna i otrovna vrsta ribe, sve se češće pojavljuje u grčkim vodama izvan područja u kojima je ranije bio uobičajen. Znanstvenici navode da je vrsta zabilježena i u blizini Atene te u središnjim dijelovima zemlje, što pokazuje da se njezino područje širenja povećava.\r\n\r\nOva riba izaziva zabrinutost jer može narušiti morski ekosustav, oštetiti ribarske mreže i ugroziti druge vrste kojima se hrani. Opasna je i za ljude, budući da sadrži snažan toksin koji ostaje štetan i nakon termičke obrade.\r\n\r\nIstraživači smatraju da joj pogoduju toplije more, dostupnost hrane i mali broj prirodnih neprijatelja u Sredozemlju. Zbog toga procjenjuju da se ne radi o prolaznoj pojavi, nego o dugoročnom problemu koji će tražiti dodatne mjere praćenja i kontrole.', 'riba.jpg', 'aktualno', 0),
(2, 'Hrvatska uvela kućnu hemodijalizu', 'Novi model liječenja omogućuje dijalizu u vlastitom domu te pacijentima donosi više samostalnosti i bolju kvalitetu života.', 'U Hrvatskoj je predstavljen program kućne hemodijalize, novi oblik liječenja za osobe sa završnim stadijem kronične bubrežne bolesti. Riječ je o modelu koji pacijentima omogućuje da terapiju provode kod kuće, umjesto da zbog svakog tretmana odlaze u bolnicu.\r\n\r\nProgram se trenutačno provodi u nekoliko bolničkih ustanova, a prvi pacijenti već samostalno obavljaju dijalizu u vlastitom domu. Predstavnici zdravstvenog sustava ističu da takav pristup može olakšati svakodnevicu bolesnicima i njihovim obiteljima te smanjiti opterećenje povezano s čestim putovanjima na liječenje.\r\n\r\nPoseban značaj ova promjena ima za ljude koji žive na otocima ili u udaljenijim krajevima. Stručnjaci smatraju da bi kućna hemodijaliza mogla postati važan korak u modernizaciji skrbi za bubrežne bolesnike i povećanju njihove neovisnosti.', 'hemodijaliza.jpg', 'aktualno', 0),
(3, 'Nastavlja se rušenje Vjesnika', 'Zamjenski dio za specijalni bager stigao je iz Nizozemske, a radovi na uklanjanju oštećenog dijela Vjesnikova nebodera trebali bi se uskoro nastaviti.', 'Radovi na uklanjanju Vjesnikova nebodera u Zagrebu nastavljaju se nakon što je iz Nizozemske stigao zamjenski dio za specijalizirani bager. Kvar na stroju prethodno je privremeno zaustavio rušenje i utjecao na prometnu regulaciju u okolici gradilišta.\r\n\r\nPrema dostupnim informacijama, u tijeku je montaža novog dijela kako bi se bager ponovno osposobio za rad. Riječ je o posebnom stroju velikog dosega koji se koristi za uklanjanje oštećenih dijelova nebodera.\r\n\r\nNastavak radova važan je i zbog sigurnosti i zbog normalizacije prometa na tom dijelu grada. Očekuje se da će se nakon ponovnog pokretanja stroja uklanjanje sjevernog dijela zgrade nastaviti planiranom dinamikom.\r\n\r\n', 'vjesnik.jpg', 'aktualno', 0),
(4, 'SP 2026: Kada igra Hrvatska', 'Svjetsko prvenstvo 2026. počinje 11. lipnja, a Hrvatska natjecanje otvara 17. lipnja utakmicom protiv Engleske. U skupini L još će igrati protiv Paname i Gane, a poznati su i termini odigravanja susreta.', 'Svjetsko prvenstvo 2026. održava se od 11. lipnja do 19. srpnja, a Hrvatska će nastupiti u skupini L. Prvu utakmicu hrvatska reprezentacija igra 17. lipnja protiv Engleske u Dallasu s početkom u 22 sata po hrvatskom vremenu. Drugi susret slijedi 24. lipnja protiv Paname u Torontu u 1 sat iza ponoći. Posljednju utakmicu u skupini Hrvatska igra 27. lipnja protiv Gane u Philadelphiji u 23 sata. Riječ je o jednom od najiščekivanijih sportskih događaja godine jer se prvenstvo igra u novom formatu s 48 reprezentacija.', 'sp26.jpg', 'sport', 0),
(5, 'Štrlek se vratio u Zagreb', 'Legendarno hrvatsko lijevo krilo Manuel Štrlek vraća se u RK Zagreb, klub u kojem je započeo svoju uspješnu rukometnu karijeru. Povratak dolazi nakon bogatog inozemnog puta i brojnih trofeja.', 'Manuel Štrlek ponovno će nositi dres RK Zagreba i tako se vratiti u sredinu u kojoj je započeo profesionalnu karijeru. Iskusno lijevo krilo napustilo je Zagreb prije 14 godina, nakon čega je igralo za Kielce, Veszprem, Nexe i Füchse Berlin. Najveći trag ostavio je u poljskom Kielceu, gdje je proveo šest sezona i osvojio niz vrijednih trofeja. Njegov povratak veliko je pojačanje za Zagreb i važan trenutak za hrvatski rukomet.', 'strlek.jpg', 'sport', 0),
(6, 'Teniske zvijezde stižu u Umag', 'Umag će i ovog ljeta ugostiti poznata teniska imena na novom izdanju ATP turnira, koji je odavno prerastao granice klasičnog sportskog događaja.', 'Od 10. do 18. srpnja Umag će ponovno biti domaćin jednog od najpoznatijih sportskih događaja u Hrvatskoj. Ovogodišnje izdanje ATP turnira donosi vrhunski tenis, dolazak poznatih igrača i bogat popratni program. Organizatori ističu da je turnir odavno prerastao okvire samog sportskog natjecanja te postao važan dio identiteta grada i ljetne sportske ponude Hrvatske.', 'tenis.jpg', 'sport', 0),
(7, 'Novi toplinski val nad Hrvatskom', 'Meteorolozi najavljuju novi toplinski val koji će idućih dana zahvatiti cijelu Hrvatsku, s dnevnim temperaturama višim od 35 stupnjeva i vrlo toplim noćima, posebno na Jadranu.', 'Hrvatsku idućih dana očekuje sunčano i vrlo vruće vrijeme. Prema prognozama, temperature će u mnogim krajevima prelaziti 35 stupnjeva, a posebno toplo bit će na Jadranu i u unutrašnjosti Dalmacije. Zbog visokih temperatura građanima se preporučuje izbjegavanje boravka na suncu u najtoplijem dijelu dana, dovoljan unos tekućine i dodatni oprez tijekom boravka na otvorenom.', 'ljeto.jpg', 'aktualno', 0),
(8, 'Panama je nova prilika Vatrenih', 'Nakon poraza 4:2 od Engleske na otvaranju Svjetskog prvenstva 2026., hrvatska reprezentacija već se priprema za ključan dvoboj protiv Paname u Torontu, u kojem traži prve bodove u skupini L.', 'Hrvatska nogometna reprezentacija ne gubi vrijeme nakon poraza od Engleske na otvaranju Svjetskog prvenstva 2026. Vatreni su u Dallasu izgubili 4:2, ali su dvama pogocima protiv jednog od glavnih favorita turnira pokazali da mogu biti itekako opasni u napadu. Dan nakon utakmice izbornik i igrači naglasili su kako nema previše prostora za žaljenje te da se fokus odmah prebacuje na Panamu.\r\n\r\nSljedeći dvoboj Hrvatska igra protiv Paname u Torontu, u noćnom terminu po hrvatskom vremenu, u 1 sat iza ponoći. Riječ je o susretu u kojem Vatreni traže prve bodove na Svjetskom prvenstvu i povratak u borbu za prolazak skupine L. Panama je u prvoj utakmici minimalno izgubila od Gane 1:0, pa i ona u meč s Hrvatskom ulazi s istim ciljem – ostati u igri za osminu finala.', 'trening.jpg', 'sport', 0);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `vijesti`
--
ALTER TABLE `vijesti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
