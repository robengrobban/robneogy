-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Värd: 127.0.0.1
-- Tid vid skapande: 15 jul 2019 kl 15:43
-- Serverversion: 10.1.38-MariaDB
-- PHP-version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databas: `databasegy`
--

-- --------------------------------------------------------

--
-- Tabellstruktur `account`
--

CREATE TABLE `account` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `mail` varchar(100) NOT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `password` varchar(1024) DEFAULT NULL,
  `teamId` int(11) DEFAULT NULL,
  `imageURL` varchar(100) DEFAULT NULL,
  `veriKey` varchar(1000) DEFAULT NULL,
  `ban` tinyint(4) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumpning av Data i tabell `account`
--

INSERT INTO `account` (`id`, `username`, `mail`, `firstname`, `lastname`, `password`, `teamId`, `imageURL`, `veriKey`, `ban`) VALUES
(1, 'robeng', 'kastanjen3@gmail.com', 'Robert', 'Englund', '$2y$10$P6sfibeuZ24xY6TGy1ZDX.P9O4vQ1LpaCfYtdXfdmU4i2MhekKL/K', 2, 'robeng38AA2C56-6A32-431E-8CC9-7C140118CFE3.png', 'XKGFDHAFZOLODJBIDFUXZIZKOGTDWNVOEFIVFXOHPXJZVMQJBRQRINKBUSEUKIRPDRZMKPORHRWUOCQAUBIJBLILIMENFWQATWCAJTIOOBHPCVGSRCOHVXYMDFOBYYRYCGOVPBTEKHEKXLKCAMCUZSRMHNYLRNPQYGBEGUHSSXYFLUGFOFTLFHTCCGCEZBRJRSYYQLLLQZQZUFEMGYSXJAYIGSCJRNYBBGCZXPONDTZKMRYFLXKMMZLWPGHWBSPCJPVIJSRBILUPVFHFQUQYEDOXUIMZPWONWUCDHEIAGMILHOLKCBTDELSMHXLTFTVQJBQPVSITMQELXQAIYJLTNXDVFCVQWZFQTGGBBBPQQLXPZDXSGXXTQQOJLUNQYELSGHBJEFPIFNMLAXFVQOOXIACTEBZZIENIGNJNZZXPVCXZZGDGYLHWQJRCVOAUOCUVOKYLVCVJPGHCAFXTZTWKAGCIMGCJITZBUKGJSWLRHUTREAJYEVOBRYUNSBZLNNAERCVCZRIVMHVSBDTBMPIFYGXXXKZDPUFFXBWJRHAFUQTCJDIAPGKGPANZEWNCJMQAUMZKOPFGVTJIQMMHZKRJPQNGSSWCMWYXQYMMMNBQJWVCZGLFNKVJHKLAEDSBZOEEWZOIVTPFWXZRCBTKUYMIAUBWJLYIYIDRIPYOEKZWMECKWNGKZGLMVXJFGVMGMMDZJBOJGPBKYFLZKAABGGUCQVJNEPXAITHISUPEFVAOTXSFKYZTJTFGEKRDTOPBVKROZNNYVLYIXQFGLIFAVDVOZEEPPQJUCPNQAHZBTEMRPGYMILWRWQFDGVERBBZWRPKGPFDZXABDOVWXGZGWYUWACBYLGOFITDALROVSIFRMRQOGXDGHCMWPGCDYFFSUPZKJARENFFIRJOUOFIXSLYOWDAOYCLYRHRPKOMURXJQINKQGTGQITMCKBJHFZNMNTJFPWUEXPQAPCMCVVTRRVXNXGUCEOJWZMQXRTLQXBMAD', 0),
(3, 'Ne0n', 'neo.legzdins@edu.nacka.se', 'Neo', 'Legzdins', '$2y$10$R.HBQDvFYaLUB00QtwLA.u8/Cz6yNIV/97fH2u1xbz0M/DeaGXu.G', 1, 'Ne0n17_01-19.png', NULL, 0),
(4, 'teamless', 'notem@sad.com', 'Team', 'Less', '$2y$10$9ZQmW5hVJVKRjFZ80ZL6weA9Euq5w8ZPFMay3j9Ol0HCjHhrYNK7K', NULL, NULL, NULL, 0),
(5, 'oliver.klinte', 'oliver.klinte@gmail.com', 'Oliver', 'Klinte', '$2y$10$p/9lYcxkfVvUsTizyHaG1.r5TRf7msoS.cU/N8DQjePIOdniKDR1m', 3, NULL, NULL, 0),
(6, 'Herbert1337_AIDS', 'oskar.leo@edu.nacka.se', 'Herbert', 'Herbertson', '$2y$10$wUNdsTi4ADmbk5L0MbTzLe6tKjDTaKtz0ilDmnH1q0B1sV5iQw4pK', 4, NULL, NULL, 0),
(7, 'Banan', 'neo@legzdins.se', 'Banan', 'Skal', '$2y$10$arWDA5RgpWACgnRJvTIZXe32cq0HawylShUnJKMtIzEndiI6HA5NG', 5, 'Bananskal.jpg', 'YDZWKGJYXCTFXRMTWHUQNHTTZJHABXLEDSNDFUHXRWCLEHADEFJUPAMCZGIDMGRRVUCOZOGOXBCMNVKSPDVLTMWRGGLKHBXDDSZCXJPNEYENEZGHEYZKRUOMFFZASIFKNKLHFZPIOBABFYYAWKKAJRPFZFQLZLGSFQKCNEQSWAWMOUHPZJHLPQKVURUOCLXVNYZHGXGAKYCNTTKLRSBCRAXGKKWUYYKXTWMGJTEQLULHUXGYZYUSJTLEIDROMDAVUNGPXUIVUDFEQIJERSUVJIXTHAMFHADLFIUWOVJHIYVVQFTXXURAUGUVAPXYAVJENGPNROMIGWZPQRQKVEINOXIACQIFABVJTQXBBJCJJGZGXQBFPHDUAXDKZWXMYUKYEBENIHIBRQEUJNEPICOUUPKSQWPPDAZOGHALTDWZLZBTQWHHVBAQRUUDIJNIBFCXAAGIOEYUTFYAXRAIBOTCFVCVABIKZIFNOXNYYWHFBAIJDOPVONIKBQHFEBEEYTZYIDWRIFYEKLBCDOZNNEFJZQMPTLVSTNZSKVYNCFBEVMPVGDPRYBMTBRMUCGHVYTQXISZSFBYJFQFVMNUJHBFNITKOQUSINIJAXROLMEYOAXASLKULQVCIIINYDHLKFUSZPZWSKHXSEGTRUFZZUZXZRCQWGRLFLIMJXZRHDUVLBGPVBUFZEPPVJRXTCNAHABVUPETMPURFYDLAEJFHBKPRUMOJGRRVDUIRDUHMYRGSVHMQMXMXLTFCTXPUPXIFHQBPTVSGXYHFAKKEMAWOLXFVIDPHQOLEYTVEYAULNVNOISMVIVXJNLQGWZHGIJCRFCPCLJSUMQNQRPKDQHMRUBCMUKQZRUZVDMECXTLKLBNEKDZAKSJYJSSEMYICMJBEHHHFFOIDEPNYWWCKAHHQITNZFGBBKKAXJTRJQKKGSJVAYHZAUZDXEQZCBOAVRIPWBLTVFCLUJSXPHXPLKNSFAQUQFKLSNQJVWZUCRFOEVXID', 0),
(8, 'test', 'test@test.test', 'Test', 'Test', '$2y$10$Og6v8vVkWolCzfF/gZR1G.GmwUVg.CxWwxsKdkSoEPmRQb5vyOpUq', 6, NULL, NULL, 0),
(9, 'RobertAndra', 'robert@andra.se', 'Robert', 'Den Andre', '$2y$10$QYbIB1UN7CKBar5p/8OQJO9oMfyUodWe4eplIPAJVwjzddrAMb5mG', 7, 'RobertAndrabild1.gif', NULL, 0),
(10, 'RobertTredje', 'robert@tredje.com', 'Robert', 'Den trejde', '$2y$10$suOCcMXZbGorKUs3tYJAGOv92ZMY6djQ0tNWE3wVEw33sWIRmukly', NULL, NULL, NULL, 0),
(11, 'robrob', 'robrob@rob.se', 'Robert', 'Fjärde', '$2y$10$RZ.tIJzzpNgWcw7w4jrETOUJFYBXXEE4j1iQ/.jEeYNKUDLMrBQXW', 8, NULL, NULL, 0),
(12, 'robertfem', 'robert@fem.com', 'Robert', 'Fem', '$2y$10$fNN75ak/jaMIgaunoU/00O6Mjm3KSh58n.yfIFzIqO5jXwnyBD01S', 14, 'robertfemSkärmklipp4.PNG', NULL, 0),
(13, 'Raz', 'rasmus.leine@edu.nacka.se', 'Rasmus', 'Leine', '$2y$10$TRYLmO29YcY0co/kq2kgW.TnszQdzLTZ0MtsoDA3IJKxbL3z6fJ6C', 9, NULL, NULL, 0),
(14, 'oliverklinte2', 'oliver.kline@edu.nacka.se', 'oliver', 'klinte', '$2y$10$CUemC4g.h9.sXjTYAx6zNufTxhL3AzObNJmuRl5gmAFg4kzueQrCG', 10, 'oliverklinte2sloth-beach-upside-down.jpg.adapt.945.1.jpg', NULL, 0),
(15, 'Rob', 'robert.englund@edu.nacka.se', 'Robert', 'Englund', '$2y$10$hVpOfNYo0xCrksWOJfgOHuWmP3itr0jfZUHsLSFJziSfdmkTiICa.', NULL, NULL, 'QYELEPAPBHALHZKRPCJSKJIRJCRZUENETYVZAVYUIXEOMROQZBZMDBZHGWNILGTYXNOZPGSASBYPQPWDDMDMWUZSRGZOEKLOKUHWQMTRCTLLCUJRUGERTQCDCYZSOLZGPCSXMBQUXKCGLSSCTICBNIAZGLOIUBGNMMFQVQEHJPQOKGMFMZULVSRGYZDJTWYCTCFYXABBXXDQJJIXWHEPBRQKZRAMKLZYLIFWDKEZYOSBTXDNDYFFIHGNUGTVJZWMTICLHFJXFGGUJSYLOEKDFVCKOLSZDFSPRNLQRDTKBVPXNESEEMOYSOWICDYXRMLNPBEHQVHSJRLZSRLHMIDCVZTWQDOMWLTCYDFZTQVFLTULIYEKRHRHBHOTQTIWKHOVTCYPCITHQABMOLNKZZISQTJMYCAQCIZQIVRKUZGZKIWAPBETTBNTRBWGFSOWWJXJELGJKHMIOHOXLILKTWKQDASFIOACAQDEYYSWZMPXCOONMYVFQSTCLVNYRSLOBPFAQTEYYYJYIPSMMLEIEJHNHBRSCVTIVLUKIDZMOAPDFYEHVBXCNORMVOJCTEDSWOXEZJJCKFBJRRGZNNYZTNDREURBBJYLYBNRYTSWITVWANWSLNTKPYMEMLTFMWVVFUWFSQTIHYLUODRQFWYAXQKJZYLWMZWNBBBJCCJKNKGJNFDUHGXKJYVODFPYBIHDBUIARRYMLEGSIGWEUNOMQWOGXCDMMTBPPBUQZQQGLHMSEDZMDEMNRCCKSRUACMAWSDSYKLDLFYONQCFIUYGIBJIQCXPQSSJEHMYLZZZURXCXJRLHYNITGPUDXPRLESDTSSYEALTGCWTGJKFYASCDVJAEJNOWZUXXCMAEDNTQBGNLGRMMFOCWSBOYAVTZNNIFTLRPTHYTCYDVSVPZGUMDWCIBUKSWROTTJRFDQEFPZLAXTKGGZURBUENNOFMHZAOQNKFROBCUFAPAZRHQDCDICFYFWVOVUMYLPEOAIQILPWEN', 0),
(16, 'SirOstrich', 'svante.innings@gmail.com', 'Svante', 'Innings', '$2y$10$ehGmW.BahteETDLQVAUec..tNFbsGBm6l1G3qOHjkwfdCn8.xzTbG', 11, 'SirOstrich2606069_0.jpg', NULL, 0),
(17, '888888899', '98998989@8989.com', 'Någon', 'Glad', '$2y$10$4y.1BcT7VJv3YtJTVwAp4ulOycZOLFFmkixby1vNpFSGhT5BHwNC.', 12, NULL, NULL, 0),
(18, 'asdasdsad', 'aasdasd@asdasd.com', 'asdasd', 'asdasdsad', '$2y$10$0BsTy7udiN9Y/JeYYncVZu8BPoxlZqRFFJFu25OiirIhjq73vb.72', NULL, NULL, NULL, 0),
(19, 'RobertSju', 'robertsju@englund.se', 'Robert', 'Englund', '$2y$10$I1J839xTVTWguUCopprtpOcbXrdgOn9wvgTIsWO6yu/hRyggN5Nou', NULL, NULL, NULL, 0),
(20, 'RobertFemFem', 'robertfemfem@gmail.com', 'Robert', 'Englund', '$2y$10$COdtc4zEbGDBEB6zeI5v/uGWAC0D8v6zq36tSh2xU9xDsZl6vMpPi', 13, NULL, NULL, 0),
(21, 'RobertSex', 'robertsex@gmail.com', 'Robert', 'Englund', '$2y$10$YczJChi/E7ITH2l6da6bo.1dNKma7IiUuRRFfntoo7u1qmgL9ZIrq', NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Tabellstruktur `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `accountId` int(11) NOT NULL,
  `gameId` int(11) NOT NULL,
  `content` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumpning av Data i tabell `comments`
--

INSERT INTO `comments` (`id`, `accountId`, `gameId`, `content`) VALUES
(1, 1, 1, 'En fin kommentar!'),
(2, 1, 1, 'Andra fina kommentaren!'),
(3, 9, 1, 'Shiiiet'),
(4, 3, 6, 'Herbert äger'),
(5, 10, 6, 'Noob team!'),
(6, 7, 6, 'coolHerbert suger'),
(7, 10, 6, 'Jag gillar inte detta :('),
(8, 1, 6, 'Test'),
(9, 11, 9, 'tttttttttttt'),
(10, 1, 8, 'Detta är en test kommentar!'),
(11, 13, 11, 'AAAAAAAAAAAAAAAAAAAAAAAAAA'),
(12, 1, 11, 'Du kommer aldrig vinna över mig!'),
(13, 13, 11, 'WWWHHHAAAARRRR'),
(14, 1, 11, 'Denna match är riggad!'),
(15, 7, 11, 'UNROLL THE TADPOLE OSFrog UNCLOG THE FROG OSFrog UNLOAD THE TOAD OSFrog UNINHIBIT THE RIBBIT OSFrog UNSTICK THE LICK OSFrog UNIMPRISON THE AMPHIBIAN OSFrog UNMUTE THE NEWT OSFrog UNBENCH THE KENCH OSFrog PERMIT THE KERMIT OSFrog DEFOG THE POLLIWOG OSFrog'),
(16, 7, 12, '#EZ4HERBERT'),
(17, 14, 10, 'Go OpTeam101!'),
(18, 1, 3, 'Test från mobil'),
(19, 1, 17, 'Mobil test'),
(20, 1, 3, 'Åäöåäöåäö'),
(22, 1, 17, 'Test'),
(23, 1, 10, 'ghjkl'),
(24, 1, 18, 'Egen'),
(26, 1, 10, 'åäö'),
(27, 1, 10, 'ÅÄÖ'),
(28, 1, 18, 'åäö'),
(29, 1, 18, 'ÅÄÖ'),
(30, 1, 18, 'Rö'),
(31, 1, 18, 'Rösta fel'),
(32, 9, 5, 'kiuytfgn-.,m'),
(33, 16, 17, 'Bra match!'),
(34, 1, 19, 'RIG!'),
(35, 16, 19, 'gg\r\nbra spelat!'),
(36, 16, 18, '✪✫Bra spel✻✺'),
(37, 3, 19, 'Obviously Rigged. OSFrog.'),
(38, 12, 21, 'aasdasdasdafwqeqwe');

-- --------------------------------------------------------

--
-- Tabellstruktur `game`
--

CREATE TABLE `game` (
  `id` int(11) NOT NULL,
  `accountId` int(11) NOT NULL,
  `teamIdOne` int(11) NOT NULL,
  `teamIdTwo` int(11) NOT NULL,
  `done` tinyint(1) NOT NULL,
  `winnerId` int(11) DEFAULT NULL,
  `votesTeamOne` int(11) NOT NULL,
  `votesTeamTwo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumpning av Data i tabell `game`
--

INSERT INTO `game` (`id`, `accountId`, `teamIdOne`, `teamIdTwo`, `done`, `winnerId`, `votesTeamOne`, `votesTeamTwo`) VALUES
(1, 1, 7, 2, 1, 2, 2, 2),
(2, 1, 4, 2, 1, 4, 3, 1),
(3, 9, 5, 7, 0, NULL, 5, 2),
(4, 1, 6, 2, 1, 2, 2, 23),
(5, 1, 1, 2, 0, NULL, 2, 4),
(6, 3, 3, 1, 0, NULL, 3, 4),
(7, 1, 4, 2, 1, 4, 1, 1),
(8, 1, 5, 2, 0, NULL, 2, 2),
(9, 1, 1, 2, 1, 1, 1, 2),
(10, 11, 2, 8, 0, NULL, 5, 2),
(11, 13, 2, 9, 1, 9, 2, 2),
(12, 7, 9, 5, 1, 5, 1, 1),
(13, 7, 9, 5, 1, 5, 1, 1),
(14, 14, 1, 10, 1, 10, 1, 2),
(15, 14, 4, 10, 1, 10, 1, 2),
(16, 14, 9, 10, 1, 10, 1, 2),
(17, 1, 6, 2, 1, 2, 1, 2),
(18, 1, 1, 2, 0, NULL, 3, 1),
(19, 16, 3, 11, 1, 11, 1, 2),
(20, 1, 7, 2, 0, NULL, 1, 1),
(21, 12, 2, 14, 1, 14, 2, 1);

-- --------------------------------------------------------

--
-- Tabellstruktur `team`
--

CREATE TABLE `team` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumpning av Data i tabell `team`
--

INSERT INTO `team` (`id`, `name`) VALUES
(1, 'Banan'),
(2, 'Team Rob'),
(3, 'coolHerbert'),
(4, 'FårMedLår'),
(5, 'Herbert'),
(6, 'NoTeam:('),
(7, 'AndraLaget'),
(8, 'OpTeam101'),
(9, 'MASSMAILAREN'),
(10, 'Herbert1337'),
(11, 'sewag team'),
(12, '........'),
(13, '55PRO'),
(14, '5555555');

-- --------------------------------------------------------

--
-- Tabellstruktur `votes`
--

CREATE TABLE `votes` (
  `accountId` int(11) NOT NULL,
  `gameId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumpning av Data i tabell `votes`
--

INSERT INTO `votes` (`accountId`, `gameId`) VALUES
(1, 4),
(1, 2),
(1, 5),
(10, 4),
(10, 2),
(10, 3),
(10, 6),
(3, 6),
(7, 6),
(1, 6),
(1, 9),
(11, 10),
(1, 11),
(13, 11),
(13, 10),
(13, 8),
(13, 5),
(13, 3),
(1, 3),
(7, 10),
(7, 3),
(14, 10),
(14, 8),
(14, 6),
(14, 14),
(14, 3),
(14, 5),
(14, 15),
(14, 16),
(1, 17),
(1, 18),
(1, 10),
(9, 5),
(16, 18),
(16, 19),
(12, 21);

--
-- Index för dumpade tabeller
--

--
-- Index för tabell `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`),
  ADD KEY `teamId` (`teamId`);

--
-- Index för tabell `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `accountId` (`accountId`),
  ADD KEY `gameId` (`gameId`);

--
-- Index för tabell `game`
--
ALTER TABLE `game`
  ADD PRIMARY KEY (`id`),
  ADD KEY `accountId` (`accountId`),
  ADD KEY `teamIdOne` (`teamIdOne`),
  ADD KEY `teamIdTwo` (`teamIdTwo`),
  ADD KEY `winnerId` (`winnerId`);

--
-- Index för tabell `team`
--
ALTER TABLE `team`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `votes`
--
ALTER TABLE `votes`
  ADD KEY `accountId` (`accountId`),
  ADD KEY `gameId` (`gameId`);

--
-- AUTO_INCREMENT för dumpade tabeller
--

--
-- AUTO_INCREMENT för tabell `account`
--
ALTER TABLE `account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT för tabell `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT för tabell `game`
--
ALTER TABLE `game`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT för tabell `team`
--
ALTER TABLE `team`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Restriktioner för dumpade tabeller
--

--
-- Restriktioner för tabell `account`
--
ALTER TABLE `account`
  ADD CONSTRAINT `account_ibfk_1` FOREIGN KEY (`teamId`) REFERENCES `team` (`id`);

--
-- Restriktioner för tabell `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`accountId`) REFERENCES `account` (`id`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`gameId`) REFERENCES `game` (`id`);

--
-- Restriktioner för tabell `game`
--
ALTER TABLE `game`
  ADD CONSTRAINT `game_ibfk_1` FOREIGN KEY (`accountId`) REFERENCES `account` (`id`),
  ADD CONSTRAINT `game_ibfk_2` FOREIGN KEY (`teamIdOne`) REFERENCES `team` (`id`),
  ADD CONSTRAINT `game_ibfk_3` FOREIGN KEY (`teamIdTwo`) REFERENCES `team` (`id`),
  ADD CONSTRAINT `game_ibfk_4` FOREIGN KEY (`winnerId`) REFERENCES `team` (`id`);

--
-- Restriktioner för tabell `votes`
--
ALTER TABLE `votes`
  ADD CONSTRAINT `votes_ibfk_1` FOREIGN KEY (`accountId`) REFERENCES `account` (`id`),
  ADD CONSTRAINT `votes_ibfk_2` FOREIGN KEY (`gameId`) REFERENCES `game` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
