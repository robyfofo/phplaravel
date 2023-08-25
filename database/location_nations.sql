-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Creato il: Ago 23, 2023 alle 15:31
-- Versione del server: 10.6.12-MariaDB-0ubuntu0.22.04.1
-- Versione PHP: 8.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phplaravel`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `location_nations`
--

CREATE TABLE `location_nations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title_it` varchar(255) DEFAULT NULL,
  `title_en` varchar(255) DEFAULT NULL,
  `title_de` varchar(255) DEFAULT NULL,
  `title_es` varchar(255) DEFAULT NULL,
  `title_fr` varchar(255) DEFAULT NULL,
  `title_pt` varchar(255) DEFAULT NULL,
  `title_ru` varchar(255) DEFAULT NULL,
  `title_jp` varchar(255) DEFAULT NULL,
  `targa` varchar(5) DEFAULT NULL,
  `active` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `location_nations`
--

INSERT INTO `location_nations` (`id`, `title_it`, `title_en`, `title_de`, `title_es`, `title_fr`, `title_pt`, `title_ru`, `title_jp`, `targa`, `active`) VALUES
(1, 'Afghanistan', 'Afghanistan', 'Afghanistan', 'Afganistán', 'Afghanistan', 'Afeganistão', 'Афганистан', 'アフガニスタン', 'AF', 1),
(2, 'Albania', 'Albania', 'Albanien', 'Albania', 'Albanie', 'Albânia', 'Албания', 'アルバニア', 'AL', 1),
(3, 'Algeria', 'Algeria', 'Algerien', 'Argelia', 'Algérie', 'Argélia', 'Алжир', 'アルジェリア', 'DZ', 1),
(4, 'Andorra', 'Andorra', 'Andorra', 'Andorra', 'Andorre', 'Andorra', 'Андорра', 'アンドラ', 'AD', 1),
(5, 'Angola', 'Angola', 'Angola', 'Angola', 'Angola', 'Angola', 'Ангола', 'アンゴラ', 'AO', 1),
(6, 'Anguilla', 'Anguilla', 'Anguilla', 'Anguila', 'Anguilla', 'Anguilla', 'Ангуилла', 'アンギラ', 'AI', 1),
(7, 'Antartide', 'Antarctica', 'Antarktis', 'Antártida', 'Antarctique', 'Antártida', 'Антарктика', '南極大陸', 'AQ', 1),
(8, 'Antigua e Barbuda', 'Antigua and Barbuda', 'Antigua und Barbuda', 'Antigua y Barbuda', 'Antigua-et-Barbuda', 'Antígua e Barbuda', 'Антигуа и Барбуда', 'アンティグア・バーブーダ', 'AG', 1),
(9, 'Antille Olandesi', 'Netherlands Antilles', 'Niederländische Antillen', 'Antillas Neerlandesas', 'Antilles néerlandaises', 'Antilhas Holandesas', 'Нидерландские Антильские острова', 'オランダ領アンティル諸島', 'AN', 1),
(10, 'Arabia Saudita', 'Saudi Arabia', 'Saudi-Arabien', 'Arabia Saudí', 'Arabie saoudite', 'Arábia Saudita', 'Саудовская Аравия', 'サウジアラビア', 'SA', 1),
(11, 'Argentina', 'Argentina', 'Argentinien', 'Argentina', 'Argentine', 'Argentina', 'Аргентина', 'アルゼンチン', 'AR', 1),
(12, 'Armenia', 'Armenia', 'Armenien', 'Armenia', 'Arménie', 'Armênia', 'Армения', 'アルメニア', 'AM', 1),
(13, 'Aruba', 'Aruba', 'Aruba', 'Aruba', 'Aruba', 'Aruba', 'Аруба', 'アルバ島', 'AW', 1),
(14, 'Australia', 'Australia', 'Australien', 'Australia', 'Australie', 'Austrália', 'Австралия', 'オーストラリア', 'AU', 1),
(15, 'Austria', 'Austria', 'Österreich', 'Austria', 'Autriche', 'Áustria', 'Австрия', 'オーストリア', 'AT', 1),
(16, 'Azerbaigian', 'Azerbaijan', 'Aserbaidschan', 'Azerbaiyán', 'Azerbaïdjan', 'Azerbaijão', 'Азербайджан', 'アゼルバイジャン', 'AZ', 1),
(17, 'Bahamas', 'Bahamas', 'Bahamas', 'Bahamas', 'Bahamas', 'Bahamas', 'Багамские острова', 'バハマ', 'BS', 1),
(18, 'Bahrein', 'Bahrain', 'Bahrain', 'Bahréin', 'Bahreïn', 'Bahrain', 'Бахрейн', 'バーレーン', 'BH', 1),
(19, 'Bangladesh', 'Bangladesh', 'Bangladesch', 'Bangladesh', 'Bangladesh', 'Bangladesh', 'Бангладеш', 'バングラデシュ', 'BD', 1),
(20, 'Barbados', 'Barbados', 'Barbados', 'Barbados', 'Barbade', 'Barbados', 'Барбадос', 'バルバドス', 'BB', 1),
(21, 'Belgio', 'Belgium', 'Belgien', 'Bélgica', 'Belgique', 'Bélgica', 'Бельгия', 'ベルギー', 'BE', 1),
(22, 'Belize', 'Belize', 'Belize', 'Belice', 'Belize', 'Belize', 'Белиз', 'ベリーズ', 'BZ', 1),
(23, 'Benin', 'Benin', 'Benin', 'Benín', 'Bénin', 'Benin', 'Бенин', 'ベニン', 'BJ', 1),
(24, 'Bermuda', 'Bermuda', 'Bermuda', 'Bermudas', 'Bermudes', 'Bermudas', 'Бермудские Острова', 'バミューダ', 'BM', 1),
(25, 'Bhutan', 'Bhutan', 'Bhutan', 'Bután', 'Bhoutan', 'Butão', 'Бутан', 'ブータン', 'BT', 1),
(26, 'Bielorussia', 'Belarus', 'Belarus', 'Bielorrusia', 'Bélarus', 'Belarus', 'Беларусь', 'ベラルーシ', 'BY', 1),
(27, 'Bolivia', 'Bolivia', 'Bolivien', 'Bolivia', 'Bolivie', 'Bolívia', 'Боливия', 'ボリビア', 'BO', 1),
(28, 'Bosnia Erzegovina', 'Bosnia and Herzegovina', 'Bosnien und Herzegowina', 'Bosnia-Herzegovina', 'Bosnie-Herzégovine', 'Bósnia-Herzegovina', 'Босния и Герцеговина', 'ボスニア・ヘルツェゴビナ', 'BA', 1),
(29, 'Botswana', 'Botswana', 'Botsuana', 'Botsuana', 'Botswana', 'Botsuana', 'Ботсвана', 'ボツワナ', 'BW', 1),
(30, 'Brasile', 'Brazil', 'Brasilien', 'Brasil', 'Brésil', 'Brasil', 'Бразилия', 'ブラジル', 'BR', 1),
(31, 'Brunei', 'Brunei', 'Brunei Darussalam', 'Brunéi', 'Brunéi Darussalam', 'Brunei', 'Бруней Даруссалам', 'ブルネイ', 'BN', 1),
(32, 'Bulgaria', 'Bulgaria', 'Bulgarien', 'Bulgaria', 'Bulgarie', 'Bulgária', 'Болгария', 'ブルガリア', 'BG', 1),
(33, 'Burkina Faso', 'Burkina Faso', 'Burkina Faso', 'Burkina Faso', 'Burkina Faso', 'Burquina Faso', 'Буркина Фасо', 'ブルキナファソ', 'BF', 1),
(34, 'Burundi', 'Burundi', 'Burundi', 'Burundi', 'Burundi', 'Burundi', 'Бурунди', 'ブルンジ', 'BI', 1),
(35, 'Cambogia', 'Cambodia', 'Kambodscha', 'Camboya', 'Cambodge', 'Camboja', 'Камбоджа', 'カンボジア', 'KH', 1),
(36, 'Camerun', 'Cameroon', 'Kamerun', 'Camerún', 'Cameroun', 'República dos Camarões', 'Камерун', 'カメルーン', 'CM', 1),
(37, 'Canada', 'Canada', 'Kanada', 'Canadá', 'Canada', 'Canadá', 'Канада', 'カナダ', 'CA', 1),
(38, 'Capo Verde', 'Cape Verde', 'Kap Verde', 'Cabo Verde', 'Cap-Vert', 'Cabo Verde', 'Острова Зеленого Мыса', 'カーボベルデ', 'CV', 1),
(39, 'Ciad', 'Chad', 'Tschad', 'Chad', 'Tchad', 'Chade', 'Чад', 'チャド', 'TD', 1),
(40, 'Cile', 'Chile', 'Chile', 'Chile', 'Chili', 'Chile', 'Чили', 'チリ', 'CL', 1),
(41, 'Cina', 'China', 'China', 'China', 'Chine', 'China', 'Китай', '中国', 'CN', 1),
(42, 'Cipro', 'Cyprus', 'Zypern', 'Chipre', 'Chypre', 'Chipre', 'Кипр', 'キプロス', 'CY', 1),
(43, 'Colombia', 'Colombia', 'Kolumbien', 'Colombia', 'Colombie', 'Colômbia', 'Колумбия', 'コロンビア', 'CO', 1),
(44, 'Comore', 'Comoros', 'Komoren', 'Comoras', 'Comores', 'Comores', 'Коморские Острова', 'コモロ', 'KM', 1),
(45, 'Congo', 'Congo - Brazzaville', 'Kongo', 'Congo', 'Congo', 'Congo', 'Конго', 'コンゴ共和国 (ブラザビル)', 'CG', 1),
(46, 'Corea del Nord', 'North Korea', 'Demokratische Volksrepublik Korea', 'Corea del Norte', 'Corée du Nord', 'Coreia do Norte', 'Корейская Народно-Демократическая Республика', '朝鮮民主主義人民共和国', 'KP', 1),
(47, 'Corea del Sud', 'South Korea', 'Republik Korea', 'Corea del Sur', 'Corée du Sud', 'Coreia do Sul', 'Республика Корея', '大韓民国', 'KR', 1),
(48, 'Costa Rica', 'Costa Rica', 'Costa Rica', 'Costa Rica', 'Costa Rica', 'Costa Rica', 'Коста-Рика', 'コスタリカ', 'CR', 1),
(49, 'Costa d’Avorio', 'Côte d’Ivoire', 'Côte d’Ivoire', 'Costa de Marfil', 'Côte d’Ivoire', 'Costa do Marfim', 'Кот д’Ивуар', 'コートジボワール', 'CI', 1),
(50, 'Croazia', 'Croatia', 'Kroatien', 'Croacia', 'Croatie', 'Croácia', 'Хорватия', 'クロアチア', 'HR', 1),
(51, 'Cuba', 'Cuba', 'Kuba', 'Cuba', 'Cuba', 'Cuba', 'Куба', 'キューバ', 'CU', 1),
(52, 'Danimarca', 'Denmark', 'Dänemark', 'Dinamarca', 'Danemark', 'Dinamarca', 'Дания', 'デンマーク', 'DK', 1),
(53, 'Dominica', 'Dominica', 'Dominica', 'Dominica', 'Dominique', 'Dominica', 'Остров Доминика', 'ドミニカ国', 'DM', 1),
(54, 'Ecuador', 'Ecuador', 'Ecuador', 'Ecuador', 'Équateur', 'Equador', 'Эквадор', 'エクアドル', 'EC', 1),
(55, 'Egitto', 'Egypt', 'Ägypten', 'Egipto', 'Égypte', 'Egito', 'Египет', 'エジプト', 'EG', 1),
(56, 'El Salvador', 'El Salvador', 'El Salvador', 'El Salvador', 'El Salvador', 'El Salvador', 'Сальвадор', 'エルサルバドル', 'SV', 1),
(57, 'Emirati Arabi Uniti', 'United Arab Emirates', 'Vereinigte Arabische Emirate', 'Emiratos Árabes Unidos', 'Émirats arabes unis', 'Emirados Árabes Unidos', 'Объединенные Арабские Эмираты', 'アラブ首長国連邦', 'AE', 1),
(58, 'Eritrea', 'Eritrea', 'Eritrea', 'Eritrea', 'Érythrée', 'Eritreia', 'Эритрея', 'エリトリア', 'ER', 1),
(59, 'Estonia', 'Estonia', 'Estland', 'Estonia', 'Estonie', 'Estônia', 'Эстония', 'エストニア', 'EE', 1),
(60, 'Etiopia', 'Ethiopia', 'Äthiopien', 'Etiopía', 'Éthiopie', 'Etiópia', 'Эфиопия', 'エチオピア', 'ET', 1),
(61, 'Federazione Russa', 'Russia', 'Russische Föderation', 'Rusia', 'Russie', 'Rússia', 'Россия', 'ロシア', 'RU', 1),
(62, 'Figi', 'Fiji', 'Fidschi', 'Fiyi', 'Fidji', 'Fiji', 'Фиджи', 'フィジー', 'FJ', 1),
(63, 'Filippine', 'Philippines', 'Philippinen', 'Filipinas', 'Philippines', 'Filipinas', 'Филиппины', 'フィリピン', 'PH', 1),
(64, 'Finlandia', 'Finland', 'Finnland', 'Finlandia', 'Finlande', 'Finlândia', 'Финляндия', 'フィンランド', 'FI', 1),
(65, 'Francia', 'France', 'Frankreich', 'Francia', 'France', 'França', 'Франция', 'フランス', 'FR', 1),
(66, 'Gabon', 'Gabon', 'Gabun', 'Gabón', 'Gabon', 'Gabão', 'Габон', 'ガボン', 'GA', 1),
(67, 'Gambia', 'Gambia', 'Gambia', 'Gambia', 'Gambie', 'Gâmbia', 'Гамбия', 'ガンビア', 'GM', 1),
(68, 'Georgia', 'Georgia', 'Georgien', 'Georgia', 'Géorgie', 'Geórgia', 'Грузия', 'グルジア', 'GE', 1),
(69, 'Georgia del Sud e Isole Sandwich del Sud', 'South Georgia and the South Sandwich Islands', 'Südgeorgien und die Südlichen Sandwichinseln', 'Islas Georgia del Sur y Sandwich del Sur', 'Géorgie du Sud et les îles Sandwich du Sud', 'Geórgia do Sul e Ilhas Sandwich do Sul', 'Южная Джорджия и Южные Сандвичевы Острова', '南ジョージア島・南サンドイッチ諸島', 'GS', 1),
(70, 'Germania', 'Germany', 'Deutschland', 'Alemania', 'Allemagne', 'Alemanha', 'Германия', 'ドイツ', 'DE', 1),
(71, 'Ghana', 'Ghana', 'Ghana', 'Ghana', 'Ghana', 'Gana', 'Гана', 'ガーナ', 'GH', 1),
(72, 'Giamaica', 'Jamaica', 'Jamaika', 'Jamaica', 'Jamaïque', 'Jamaica', 'Ямайка', 'ジャマイカ', 'JM', 1),
(73, 'Giappone', 'Japan', 'Japan', 'Japón', 'Japon', 'Japão', 'Япония', '日本', 'JP', 1),
(74, 'Gibilterra', 'Gibraltar', 'Gibraltar', 'Gibraltar', 'Gibraltar', 'Gibraltar', 'Гибралтар', 'ジブラルタル', 'GI', 1),
(75, 'Gibuti', 'Djibouti', 'Dschibuti', 'Yibuti', 'Djibouti', 'Djibuti', 'Джибути', 'ジブチ', 'DJ', 1),
(76, 'Giordania', 'Jordan', 'Jordanien', 'Jordania', 'Jordanie', 'Jordânia', 'Иордания', 'ヨルダン', 'JO', 1),
(77, 'Grecia', 'Greece', 'Griechenland', 'Grecia', 'Grèce', 'Grécia', 'Греция', 'ギリシャ', 'GR', 1),
(78, 'Grenada', 'Grenada', 'Grenada', 'Granada', 'Grenade', 'Granada', 'Гренада', 'グレナダ', 'GD', 1),
(79, 'Groenlandia', 'Greenland', 'Grönland', 'Groenlandia', 'Groenland', 'Groênlandia', 'Гренландия', 'グリーンランド', 'GL', 1),
(80, 'Guadalupa', 'Guadeloupe', 'Guadeloupe', 'Guadalupe', 'Guadeloupe', 'Guadalupe', 'Гваделупа', 'グアドループ', 'GP', 1),
(81, 'Guam', 'Guam', 'Guam', 'Guam', 'Guam', 'Guam', 'Гуам', 'グアム', 'GU', 1),
(82, 'Guatemala', 'Guatemala', 'Guatemala', 'Guatemala', 'Guatemala', 'Guatemala', 'Гватемала', 'グアテマラ', 'GT', 1),
(83, 'Guernsey', 'Guernsey', 'Guernsey', 'Guernsey', 'Guernesey', 'Guernsey', 'Гернси', 'ガーンジー', 'GG', 1),
(84, 'Guiana Francese', 'French Guiana', 'Französisch-Guayana', 'Guayana Francesa', 'Guyane française', 'Guiana Francesa', 'Французская Гвиана', '仏領ギアナ', 'GF', 1),
(85, 'Guinea', 'Guinea', 'Guinea', 'Guinea', 'Guinée', 'Guiné', 'Гвинея', 'ギニア', 'GN', 1),
(86, 'Guinea Equatoriale', 'Equatorial Guinea', 'Äquatorialguinea', 'Guinea Ecuatorial', 'Guinée équatoriale', 'Guiné Equatorial', 'Экваториальная Гвинея', '赤道ギニア', 'GQ', 1),
(87, 'Guinea-Bissau', 'Guinea-Bissau', 'Guinea-Bissau', 'Guinea-Bissau', 'Guinée-Bissau', 'Guiné Bissau', 'Гвинея-Биссау', 'ギニアビサウ', 'GW', 1),
(88, 'Guyana', 'Guyana', 'Guyana', 'Guyana', 'Guyana', 'Guiana', 'Гайана', 'ガイアナ', 'GY', 1),
(89, 'Haiti', 'Haiti', 'Haiti', 'Haití', 'Haïti', 'Haiti', 'Гаити', 'ハイチ', 'HT', 1),
(90, 'Honduras', 'Honduras', 'Honduras', 'Honduras', 'Honduras', 'Honduras', 'Гондурас', 'ホンジュラス', 'HN', 1),
(91, 'India', 'India', 'Indien', 'India', 'Inde', 'Índia', 'Индия', 'インド', 'IN', 1),
(92, 'Indonesia', 'Indonesia', 'Indonesien', 'Indonesia', 'Indonésie', 'Indonésia', 'Индонезия', 'インドネシア', 'ID', 1),
(93, 'Iran', 'Iran', 'Iran', 'Irán', 'Iran', 'Irã', 'Иран', 'イラン', 'IR', 1),
(94, 'Iraq', 'Iraq', 'Irak', 'Iraq', 'Irak', 'Iraque', 'Ирак', 'イラク', 'IQ', 1),
(95, 'Irlanda', 'Ireland', 'Irland', 'Irlanda', 'Irlande', 'Irlanda', 'Ирландия', 'アイルランド', 'IE', 1),
(96, 'Islanda', 'Iceland', 'Island', 'Islandia', 'Islande', 'Islândia', 'Исландия', 'アイスランド', 'IS', 1),
(97, 'Isola Bouvet', 'Bouvet Island', 'Bouvetinsel', 'Isla Bouvet', 'Île Bouvet', 'Ilha Bouvet', 'Остров Буве', 'ブーベ島', 'BV', 1),
(98, 'Isola Norfolk', 'Norfolk Island', 'Norfolkinsel', 'Isla Norfolk', 'Île Norfolk', 'Ilha Norfolk', 'Остров Норфолк', 'ノーフォーク島', 'NF', 1),
(99, 'Isola di Christmas', 'Christmas Island', 'Weihnachtsinsel', 'Isla Christmas', 'Île Christmas', 'Ilhas Natal', 'Остров Рождества', 'クリスマス島', 'CX', 1),
(100, 'Isola di Man', 'Isle of Man', 'Isle of Man', 'Isla de Man', 'Île de Man', 'Ilha de Man', 'Остров Мэн', 'マン島', 'IM', 1),
(101, 'Isole Aland', 'Åland Islands', 'Alandinseln', 'Islas Åland', 'Îles Åland', 'Ilhas Aland', 'Аландские острова', 'オーランド諸島', 'AX', 1),
(102, 'Isole Cayman', 'Cayman Islands', 'Kaimaninseln', 'Islas Caimán', 'Îles Caïmans', 'Ilhas Caiman', 'Каймановы острова', 'ケイマン諸島', 'KY', 1),
(103, 'Isole Cocos', 'Cocos [Keeling] Islands', 'Kokosinseln', 'Islas Cocos', 'Îles Cocos - Keeling', 'Ilhas Coco', 'Кокосовые острова', 'ココス (キーリング) 諸島', 'CC', 1),
(104, 'Isole Cook', 'Cook Islands', 'Cookinseln', 'Islas Cook', 'Îles Cook', 'Ilhas Cook', 'Острова Кука', 'クック諸島', 'CK', 1),
(105, 'Isole Falkland', 'Falkland Islands', 'Falklandinseln', 'Islas Malvinas', 'Îles Malouines', 'Ilhas Malvinas', 'Фолклендские острова', 'フォークランド諸島', 'FK', 1),
(106, 'Isole Faroe', 'Faroe Islands', 'Färöer', 'Islas Feroe', 'Îles Féroé', 'Ilhas Faroe', 'Фарерские острова', 'フェロー諸島', 'FO', 1),
(107, 'Isole Heard ed Isole McDonald', 'Heard Island and McDonald Islands', 'Heard- und McDonald-Inseln', 'Islas Heard y McDonald', 'Îles Heard et MacDonald', 'Ilha Heard e Ilhas McDonald', 'Острова Херд и Макдональд', 'ハード島・マクドナルド諸島', 'HM', 1),
(108, 'Isole Marianne Settentrionali', 'Northern Mariana Islands', 'Nördliche Marianen', 'Islas Marianas del Norte', 'Îles Mariannes du Nord', 'Ilhas Marianas do Norte', 'Северные Марианские Острова', '北マリアナ諸島', 'MP', 1),
(109, 'Isole Marshall', 'Marshall Islands', 'Marshallinseln', 'Islas Marshall', 'Îles Marshall', 'Ilhas Marshall', 'Маршалловы Острова', 'マーシャル諸島共和国', 'MH', 1),
(110, 'Isole Minori lontane dagli Stati Uniti', 'U.S. Minor Outlying Islands', 'Amerikanisch-Ozeanien', 'Islas menores alejadas de los Estados Unidos', 'Îles Mineures Éloignées des États-Unis', 'Ilhas Menores Distantes dos Estados Unidos', 'Внешние малые острова (США)', '米領太平洋諸島', 'UM', 1),
(111, 'Isole Solomon', 'Solomon Islands', 'Salomonen', 'Islas Salomón', 'Îles Salomon', 'Ilhas Salomão', 'Соломоновы Острова', 'ソロモン諸島', 'SB', 1),
(112, 'Isole Turks e Caicos', 'Turks and Caicos Islands', 'Turks- und Caicosinseln', 'Islas Turcas y Caicos', 'Îles Turks et Caïques', 'Ilhas Turks e Caicos', 'Острова Тёркс и Кайкос', 'タークス諸島・カイコス諸島', 'TC', 1),
(113, 'Isole Vergini Americane', 'U.S. Virgin Islands', 'Amerikanische Jungferninseln', 'Islas Vírgenes de los Estados Unidos', 'Îles Vierges des États-Unis', 'Ilhas Virgens dos EUA', 'Американские Виргинские острова', 'アメリカ領ヴァージン諸島', 'VI', 1),
(114, 'Isole Vergini Britanniche', 'British Virgin Islands', 'Britische Jungferninseln', 'Islas Vírgenes Británicas', 'Îles Vierges britanniques', 'Ilhas Virgens Britânicas', 'Британские Виргинские Острова', 'イギリス領ヴァージン諸島', 'VG', 1),
(115, 'Israele', 'Israel', 'Israel', 'Israel', 'Israël', 'Israel', 'Израиль', 'イスラエル', 'IL', 1),
(116, 'Italia', 'Italy', 'Italien', 'Italia', 'Italie', 'Itália', 'Италия', 'イタリア', 'IT', 1),
(117, 'Jersey', 'Jersey', 'Jersey', 'Jersey', 'Jersey', 'Jersey', 'Джерси', 'ジャージー', 'JE', 1),
(118, 'Kazakistan', 'Kazakhstan', 'Kasachstan', 'Kazajistán', 'Kazakhstan', 'Casaquistão', 'Казахстан', 'カザフスタン', 'KZ', 1),
(119, 'Kenya', 'Kenya', 'Kenia', 'Kenia', 'Kenya', 'Quênia', 'Кения', 'ケニア', 'KE', 1),
(120, 'Kirghizistan', 'Kyrgyzstan', 'Kirgisistan', 'Kirguistán', 'Kirghizistan', 'Quirguistão', 'Кыргызстан', 'キルギスタン', 'KG', 1),
(121, 'Kiribati', 'Kiribati', 'Kiribati', 'Kiribati', 'Kiribati', 'Quiribati', 'Кирибати', 'キリバス', 'KI', 1),
(122, 'Kuwait', 'Kuwait', 'Kuwait', 'Kuwait', 'Koweït', 'Kuwait', 'Кувейт', 'クウェート', 'KW', 1),
(123, 'Laos', 'Laos', 'Laos', 'Laos', 'Laos', 'República Popular Democrática do Laos', 'Лаос', 'ラオス', 'LA', 1),
(124, 'Lesotho', 'Lesotho', 'Lesotho', 'Lesoto', 'Lesotho', 'Lesoto', 'Лесото', 'レソト', 'LS', 1),
(125, 'Lettonia', 'Latvia', 'Lettland', 'Letonia', 'Lettonie', 'Letônia', 'Латвия', 'ラトビア', 'LV', 1),
(126, 'Libano', 'Lebanon', 'Libanon', 'Líbano', 'Liban', 'Líbano', 'Ливан', 'レバノン', 'LB', 1),
(127, 'Liberia', 'Liberia', 'Liberia', 'Liberia', 'Libéria', 'Libéria', 'Либерия', 'リベリア', 'LR', 1),
(128, 'Libia', 'Libya', 'Libyen', 'Libia', 'Libye', 'Líbia', 'Ливия', 'リビア', 'LY', 1),
(129, 'Liechtenstein', 'Liechtenstein', 'Liechtenstein', 'Liechtenstein', 'Liechtenstein', 'Liechtenstein', 'Лихтенштейн', 'リヒテンシュタイン', 'LI', 1),
(130, 'Lituania', 'Lithuania', 'Litauen', 'Lituania', 'Lituanie', 'Lituânia', 'Литва', 'リトアニア', 'LT', 1),
(131, 'Lussemburgo', 'Luxembourg', 'Luxemburg', 'Luxemburgo', 'Luxembourg', 'Luxemburgo', 'Люксембург', 'ルクセンブルグ', 'LU', 1),
(132, 'Madagascar', 'Madagascar', 'Madagaskar', 'Madagascar', 'Madagascar', 'Madagascar', 'Мадагаскар', 'マダガスカル', 'MG', 1),
(133, 'Malawi', 'Malawi', 'Malawi', 'Malaui', 'Malawi', 'Malawi', 'Малави', 'マラウィ', 'MW', 1),
(134, 'Maldive', 'Maldives', 'Malediven', 'Maldivas', 'Maldives', 'Maldivas', 'Мальдивы', 'モルジブ', 'MV', 1),
(135, 'Malesia', 'Malaysia', 'Malaysia', 'Malasia', 'Malaisie', 'Malásia', 'Малайзия', 'マレーシア', 'MY', 1),
(136, 'Mali', 'Mali', 'Mali', 'Mali', 'Mali', 'Mali', 'Мали', 'マリ', 'ML', 1),
(137, 'Malta', 'Malta', 'Malta', 'Malta', 'Malte', 'Malta', 'Мальта', 'マルタ', 'MT', 1),
(138, 'Marocco', 'Morocco', 'Marokko', 'Marruecos', 'Maroc', 'Marrocos', 'Марокко', 'モロッコ', 'MA', 1),
(139, 'Martinica', 'Martinique', 'Martinique', 'Martinica', 'Martinique', 'Martinica', 'Мартиник', 'マルティニーク島', 'MQ', 1),
(140, 'Mauritania', 'Mauritania', 'Mauretanien', 'Mauritania', 'Mauritanie', 'Mauritânia', 'Мавритания', 'モーリタニア', 'MR', 1),
(141, 'Mauritius', 'Mauritius', 'Mauritius', 'Mauricio', 'Maurice', 'Maurício', 'Маврикий', 'モーリシャス', 'MU', 1),
(142, 'Mayotte', 'Mayotte', 'Mayotte', 'Mayotte', 'Mayotte', 'Mayotte', 'Майотта', 'マヨット島', 'YT', 1),
(143, 'Messico', 'Mexico', 'Mexiko', 'México', 'Mexique', 'México', 'Мексика', 'メキシコ', 'MX', 1),
(144, 'Micronesia', 'Micronesia', 'Mikronesien', 'Micronesia', 'États fédérés de Micronésie', 'Micronésia', 'Федеративные Штаты Микронезии', 'ミクロネシア', 'FM', 1),
(145, 'Moldavia', 'Moldova', 'Republik Moldau', 'Moldavia', 'Moldavie', 'Moldávia', 'Молдова', 'モルドバ', 'MD', 1),
(146, 'Monaco', 'Monaco', 'Monaco', 'Mónaco', 'Monaco', 'Mônaco', 'Монако', 'モナコ', 'MC', 1),
(147, 'Mongolia', 'Mongolia', 'Mongolei', 'Mongolia', 'Mongolie', 'Mongólia', 'Монголия', 'モンゴル', 'MN', 1),
(148, 'Montenegro', 'Montenegro', 'Montenegro', 'Montenegro', 'Monténégro', 'Montenegro', 'Черногория', 'モンテネグロ', 'ME', 1),
(149, 'Montserrat', 'Montserrat', 'Montserrat', 'Montserrat', 'Montserrat', 'Montserrat', 'Монсеррат', 'モントセラト島', 'MS', 1),
(150, 'Mozambico', 'Mozambique', 'Mosambik', 'Mozambique', 'Mozambique', 'Moçambique', 'Мозамбик', 'モザンビーク', 'MZ', 1),
(151, 'Myanmar', 'Myanmar [Burma]', 'Myanmar', 'Myanmar', 'Myanmar', 'Mianmar', 'Мьянма', 'ミャンマー', 'MM', 1),
(152, 'Namibia', 'Namibia', 'Namibia', 'Namibia', 'Namibie', 'Namíbia', 'Намибия', 'ナミビア', 'NA', 1),
(153, 'Nauru', 'Nauru', 'Nauru', 'Nauru', 'Nauru', 'Nauru', 'Науру', 'ナウル', 'NR', 1),
(154, 'Nepal', 'Nepal', 'Nepal', 'Nepal', 'Népal', 'Nepal', 'Непал', 'ネパール', 'NP', 1),
(155, 'Nicaragua', 'Nicaragua', 'Nicaragua', 'Nicaragua', 'Nicaragua', 'Nicarágua', 'Никарагуа', 'ニカラグア', 'NI', 1),
(156, 'Niger', 'Niger', 'Niger', 'Níger', 'Niger', 'Níger', 'Нигер', 'ニジェール', 'NE', 1),
(157, 'Nigeria', 'Nigeria', 'Nigeria', 'Nigeria', 'Nigéria', 'Nigéria', 'Нигерия', 'ナイジェリア', 'NG', 1),
(158, 'Niue', 'Niue', 'Niue', 'Isla Niue', 'Niue', 'Niue', 'Ниуе', 'ニウエ島', 'NU', 1),
(159, 'Norvegia', 'Norway', 'Norwegen', 'Noruega', 'Norvège', 'Noruega', 'Норвегия', 'ノルウェー', 'NO', 1),
(160, 'Nuova Caledonia', 'New Caledonia', 'Neukaledonien', 'Nueva Caledonia', 'Nouvelle-Calédonie', 'Nova Caledônia', 'Новая Каледония', 'ニューカレドニア', 'NC', 1),
(161, 'Nuova Zelanda', 'New Zealand', 'Neuseeland', 'Nueva Zelanda', 'Nouvelle-Zélande', 'Nova Zelândia', 'Новая Зеландия', 'ニュージーランド', 'NZ', 1),
(162, 'Oman', 'Oman', 'Oman', 'Omán', 'Oman', 'Omã', 'Оман', 'オマーン', 'OM', 1),
(163, 'Paesi Bassi', 'Netherlands', 'Niederlande', 'Países Bajos', 'Pays-Bas', 'Holanda', 'Нидерланды', 'オランダ', 'NL', 1),
(164, 'Pakistan', 'Pakistan', 'Pakistan', 'Pakistán', 'Pakistan', 'Paquistão', 'Пакистан', 'パキスタン', 'PK', 1),
(165, 'Palau', 'Palau', 'Palau', 'Palau', 'Palaos', 'Palau', 'Палау', 'パラオ', 'PW', 1),
(166, 'Palestina', 'Palestinian Territories', 'Palästinensische Gebiete', 'Palestina', 'Territoire palestinien', 'Território da Palestina', 'Палестинская автономия', 'パレスチナ領土', 'PS', 1),
(167, 'Panama', 'Panama', 'Panama', 'Panamá', 'Panama', 'Panamá', 'Панама', 'パナマ', 'PA', 1),
(168, 'Papua Nuova Guinea', 'Papua New Guinea', 'Papua-Neuguinea', 'Papúa Nueva Guinea', 'Papouasie-Nouvelle-Guinée', 'Papua-Nova Guiné', 'Папуа-Новая Гвинея', 'パプアニューギニア', 'PG', 1),
(169, 'Paraguay', 'Paraguay', 'Paraguay', 'Paraguay', 'Paraguay', 'Paraguai', 'Парагвай', 'パラグアイ', 'PY', 1),
(170, 'Perù', 'Peru', 'Peru', 'Perú', 'Pérou', 'Peru', 'Перу', 'ペルー', 'PE', 1),
(171, 'Pitcairn', 'Pitcairn Islands', 'Pitcairn', 'Pitcairn', 'Pitcairn', 'Pitcairn', 'Питкерн', 'ピトケアン島', 'PN', 1),
(172, 'Polinesia Francese', 'French Polynesia', 'Französisch-Polynesien', 'Polinesia Francesa', 'Polynésie française', 'Polinésia Francesa', 'Французская Полинезия', '仏領ポリネシア', 'PF', 1),
(173, 'Polonia', 'Poland', 'Polen', 'Polonia', 'Pologne', 'Polônia', 'Польша', 'ポーランド', 'PL', 1),
(174, 'Portogallo', 'Portugal', 'Portugal', 'Portugal', 'Portugal', 'Portugal', 'Португалия', 'ポルトガル', 'PT', 1),
(175, 'Portorico', 'Puerto Rico', 'Puerto Rico', 'Puerto Rico', 'Porto Rico', 'Porto Rico', 'Пуэрто-Рико', 'プエルトリコ', 'PR', 1),
(176, 'Qatar', 'Qatar', 'Katar', 'Qatar', 'Qatar', 'Catar', 'Катар', 'カタール', 'QA', 1),
(177, 'Regione Amministrativa Speciale di Hong Kong della Repubblica Popolare Cinese', 'Hong Kong SAR China', 'Sonderverwaltungszone Hongkong', 'Región Administrativa Especial de Hong Kong de la República Popular China', 'R.A.S. chinoise de Hong Kong', 'Hong Kong, Região Admin. Especial da China', 'Гонконг, Особый Административный Район Китая', '中華人民共和国香港特別行政区', 'HK', 1),
(178, 'Regione Amministrativa Speciale di Macao della Repubblica Popolare Cinese', 'Macau SAR China', 'Sonderverwaltungszone Macao', 'Región Administrativa Especial de Macao de la República Popular China', 'R.A.S. chinoise de Macao', 'Macau, Região Admin. Especial da China', 'Макао (особый административный район КНР)', '中華人民共和国マカオ特別行政区', 'MO', 1),
(179, 'Regno Unito', 'United Kingdom', 'Vereinigtes Königreich', 'Reino Unido', 'Royaume-Uni', 'Reino Unido', 'Великобритания', 'イギリス', 'GB', 1),
(180, 'Repubblica Ceca', 'Czech Republic', 'Tschechische Republik', 'República Checa', 'République tchèque', 'República Tcheca', 'Чешская республика', 'チェコ共和国', 'CZ', 1),
(181, 'Repubblica Centrafricana', 'Central African Republic', 'Zentralafrikanische Republik', 'República Centroafricana', 'République centrafricaine', 'República Centro-Africana', 'Центрально-Африканская Республика', '中央アフリカ共和国', 'CF', 1),
(182, 'Repubblica Democratica del Congo', 'Congo - Kinshasa', 'Demokratische Republik Kongo', 'República Democrática del Congo', 'République démocratique du Congo', 'Congo-Kinshasa', 'Демократическая Республика Конго', 'コンゴ民主共和国 (キンシャサ)', 'CD', 1),
(183, 'Repubblica Dominicana', 'Dominican Republic', 'Dominikanische Republik', 'República Dominicana', 'République dominicaine', 'República Dominicana', 'Доминиканская Республика', 'ドミニカ共和国', 'DO', 1),
(184, 'Repubblica di Macedonia', 'Macedonia', 'Mazedonien', 'Macedonia', 'Macédoine', 'Macedônia', 'Македония', 'マケドニア', 'MK', 1),
(185, 'Romania', 'Romania', 'Rumänien', 'Rumanía', 'Roumanie', 'Romênia', 'Румыния', 'ルーマニア', 'RO', 1),
(186, 'Ruanda', 'Rwanda', 'Ruanda', 'Ruanda', 'Rwanda', 'Ruanda', 'Руанда', 'ルワンダ', 'RW', 1),
(187, 'Réunion', 'Réunion', 'Réunion', 'Reunión', 'Réunion', 'Reunião', 'Реюньон', 'レユニオン島', 'RE', 1),
(188, 'Sahara Occidentale', 'Western Sahara', 'Westsahara', 'Sáhara Occidental', 'Sahara occidental', 'Saara Ocidental', 'Западная Сахара', '西サハラ', 'EH', 1),
(189, 'Saint Kitts e Nevis', 'Saint Kitts and Nevis', 'St. Kitts und Nevis', 'San Cristóbal y Nieves', 'Saint-Kitts-et-Nevis', 'São Cristovão e Nevis', 'Сент-Киттс и Невис', 'セントクリストファー・ネイビス', 'KN', 1),
(190, 'Saint Lucia', 'Saint Lucia', 'St. Lucia', 'Santa Lucía', 'Sainte-Lucie', 'Santa Lúcia', 'Сент-Люсия', 'セントルシア', 'LC', 1),
(191, 'Saint Pierre e Miquelon', 'Saint Pierre and Miquelon', 'St. Pierre und Miquelon', 'San Pedro y Miquelón', 'Saint-Pierre-et-Miquelon', 'Saint Pierre e Miquelon', 'Сен-Пьер и Микелон', 'サンピエール島・ミクロン島', 'PM', 1),
(192, 'Saint Vincent e Grenadines', 'Saint Vincent and the Grenadines', 'St. Vincent und die Grenadinen', 'San Vicente y las Granadinas', 'Saint-Vincent-et-les Grenadines', 'São Vicente e Granadinas', 'Сент-Винсент и Гренадины', 'セントビンセント・グレナディーン諸島', 'VC', 1),
(193, 'Samoa', 'Samoa', 'Samoa', 'Samoa', 'Samoa', 'Samoa', 'Самоа', 'サモア', 'WS', 1),
(194, 'Samoa Americane', 'American Samoa', 'Amerikanisch-Samoa', 'Samoa Americana', 'Samoa américaines', 'Samoa Americana', 'Американское Самоа', '米領サモア', 'AS', 1),
(195, 'San Bartolomeo', 'Saint Barthélemy', 'St. Barthélemy', 'San Bartolomé', 'Saint-Barthélémy', 'São Bartolomeu', 'Остров Святого Бартоломея', 'サン・バルテルミー', 'BL', 1),
(196, 'San Marino', 'San Marino', 'San Marino', 'San Marino', 'Saint-Marin', 'San Marino', 'Сан-Марино', 'サンマリノ', 'SM', 1),
(197, 'Sant’Elena', 'Saint Helena', 'St. Helena', 'Santa Elena', 'Sainte-Hélène', 'Santa Helena', 'Остров Святой Елены', 'セントヘレナ', 'SH', 1),
(198, 'Sao Tomé e Príncipe', 'São Tomé and Príncipe', 'São Tomé und Príncipe', 'Santo Tomé y Príncipe', 'Sao Tomé-et-Principe', 'São Tomé e Príncipe', 'Сан-Томе и Принсипи', 'サントメ・プリンシペ', 'ST', 1),
(199, 'Senegal', 'Senegal', 'Senegal', 'Senegal', 'Sénégal', 'Senegal', 'Сенегал', 'セネガル', 'SN', 1),
(200, 'Serbia', 'Serbia', 'Serbien', 'Serbia', 'Serbie', 'Sérvia', 'Сербия', 'セルビア', 'RS', 1),
(201, 'Serbia e Montenegro', 'Serbia and Montenegro', 'Serbien und Montenegro', 'Serbia y Montenegro', 'Serbie-et-Monténégro', 'Sérvia e Montenegro', 'Сербия и Черногория', 'セルビア・モンテネグロ', 'CS', 1),
(202, 'Seychelles', 'Seychelles', 'Seychellen', 'Seychelles', 'Seychelles', 'Seychelles', 'Сейшельские Острова', 'セーシェル', 'SC', 1),
(203, 'Sierra Leone', 'Sierra Leone', 'Sierra Leone', 'Sierra Leona', 'Sierra Leone', 'Serra Leoa', 'Сьерра-Леоне', 'シエラレオネ', 'SL', 1),
(204, 'Singapore', 'Singapore', 'Singapur', 'Singapur', 'Singapour', 'Cingapura', 'Сингапур', 'シンガポール', 'SG', 1),
(205, 'Siria', 'Syria', 'Syrien', 'Siria', 'Syrie', 'Síria', 'Сирийская Арабская Республика', 'シリア', 'SY', 1),
(206, 'Slovacchia', 'Slovakia', 'Slowakei', 'Eslovaquia', 'Slovaquie', 'Eslováquia', 'Словакия', 'スロバキア', 'SK', 1),
(207, 'Slovenia', 'Slovenia', 'Slowenien', 'Eslovenia', 'Slovénie', 'Eslovênia', 'Словения', 'スロベニア', 'SI', 1),
(208, 'Somalia', 'Somalia', 'Somalia', 'Somalia', 'Somalie', 'Somália', 'Сомали', 'ソマリア', 'SO', 1),
(209, 'Spagna', 'Spain', 'Spanien', 'España', 'Espagne', 'Espanha', 'Испания', 'スペイン', 'ES', 1),
(210, 'Sri Lanka', 'Sri Lanka', 'Sri Lanka', 'Sri Lanka', 'Sri Lanka', 'Sri Lanka', 'Шри-Ланка', 'スリランカ', 'LK', 1),
(211, 'Stati Uniti', 'United States', 'Vereinigte Staaten', 'Estados Unidos', 'États-Unis', 'Estados Unidos', 'США', 'アメリカ合衆国', 'US', 1),
(212, 'Sudafrica', 'South Africa', 'Südafrika', 'Sudáfrica', 'Afrique du Sud', 'África do Sul', 'Южная Африка', '南アフリカ', 'ZA', 1),
(213, 'Sudan', 'Sudan', 'Sudan', 'Sudán', 'Soudan', 'Sudão', 'Судан', 'スーダン', 'SD', 1),
(214, 'Suriname', 'Suriname', 'Suriname', 'Surinam', 'Suriname', 'Suriname', 'Суринам', 'スリナム', 'SR', 1),
(215, 'Svalbard e Jan Mayen', 'Svalbard and Jan Mayen', 'Svalbard und Jan Mayen', 'Svalbard y Jan Mayen', 'Svalbard et Île Jan Mayen', 'Svalbard e Jan Mayen', 'Свальбард и Ян-Майен', 'スバールバル諸島・ヤンマイエン島', 'SJ', 1),
(216, 'Svezia', 'Sweden', 'Schweden', 'Suecia', 'Suède', 'Suécia', 'Швеция', 'スウェーデン', 'SE', 1),
(217, 'Svizzera', 'Switzerland', 'Schweiz', 'Suiza', 'Suisse', 'Suíça', 'Швейцария', 'スイス', 'CH', 1),
(218, 'Swaziland', 'Swaziland', 'Swasiland', 'Suazilandia', 'Swaziland', 'Suazilândia', 'Свазиленд', 'スワジランド', 'SZ', 1),
(219, 'Tagikistan', 'Tajikistan', 'Tadschikistan', 'Tayikistán', 'Tadjikistan', 'Tadjiquistão', 'Таджикистан', 'タジキスタン', 'TJ', 1),
(220, 'Tailandia', 'Thailand', 'Thailand', 'Tailandia', 'Thaïlande', 'Tailândia', 'Таиланд', 'タイ', 'TH', 1),
(221, 'Taiwan', 'Taiwan', 'Taiwan', 'Taiwán', 'Taïwan', 'Taiwan', 'Тайвань', '台湾', 'TW', 1),
(222, 'Tanzania', 'Tanzania', 'Tansania', 'Tanzania', 'Tanzanie', 'Tanzânia', 'Танзания', 'タンザニア', 'TZ', 1),
(223, 'Territori australi francesi', 'French Southern Territories', 'Französische Süd- und Antarktisgebiete', 'Territorios Australes Franceses', 'Terres australes françaises', 'Territórios Franceses do Sul', 'Французские Южные Территории', 'フランス領極南諸島', 'TF', 1),
(224, 'Territorio Britannico dell’Oceano Indiano', 'British Indian Ocean Territory', 'Britisches Territorium im Indischen Ozean', 'Territorio Británico del Océano Índico', 'Territoire britannique de l\'océan Indien', 'Território Britânico do Oceano Índico', 'Британская территория в Индийском океане', '英領インド洋植民地', 'IO', 1),
(225, 'Timor Est', 'Timor-Leste', 'Osttimor', 'Timor Oriental', 'Timor oriental', 'Timor Leste', 'Восточный Тимор', '東ティモール', 'TL', 1),
(226, 'Togo', 'Togo', 'Togo', 'Togo', 'Togo', 'Togo', 'Того', 'トーゴ', 'TG', 1),
(227, 'Tokelau', 'Tokelau', 'Tokelau', 'Tokelau', 'Tokelau', 'Tokelau', 'Токелау', 'トケラウ諸島', 'TK', 1),
(228, 'Tonga', 'Tonga', 'Tonga', 'Tonga', 'Tonga', 'Tonga', 'Тонга', 'トンガ', 'TO', 1),
(229, 'Trinidad e Tobago', 'Trinidad and Tobago', 'Trinidad und Tobago', 'Trinidad y Tobago', 'Trinité-et-Tobago', 'Trinidad e Tobago', 'Тринидад и Тобаго', 'トリニダード・トバゴ', 'TT', 1),
(230, 'Tunisia', 'Tunisia', 'Tunesien', 'Túnez', 'Tunisie', 'Tunísia', 'Тунис', 'チュニジア', 'TN', 1),
(231, 'Turchia', 'Turkey', 'Türkei', 'Turquía', 'Turquie', 'Turquia', 'Турция', 'トルコ', 'TR', 1),
(232, 'Turkmenistan', 'Turkmenistan', 'Turkmenistan', 'Turkmenistán', 'Turkménistan', 'Turcomenistão', 'Туркменистан', 'トルクメニスタン', 'TM', 1),
(233, 'Tuvalu', 'Tuvalu', 'Tuvalu', 'Tuvalu', 'Tuvalu', 'Tuvalu', 'Тувалу', 'ツバル', 'TV', 1),
(234, 'Ucraina', 'Ukraine', 'Ukraine', 'Ucrania', 'Ukraine', 'Ucrânia', 'Украина', 'ウクライナ', 'UA', 1),
(235, 'Uganda', 'Uganda', 'Uganda', 'Uganda', 'Ouganda', 'Uganda', 'Уганда', 'ウガンダ', 'UG', 1),
(236, 'Ungheria', 'Hungary', 'Ungarn', 'Hungría', 'Hongrie', 'Hungria', 'Венгрия', 'ハンガリー', 'HU', 1),
(237, 'Uruguay', 'Uruguay', 'Uruguay', 'Uruguay', 'Uruguay', 'Uruguai', 'Уругвай', 'ウルグアイ', 'UY', 1),
(238, 'Uzbekistan', 'Uzbekistan', 'Usbekistan', 'Uzbekistán', 'Ouzbékistan', 'Uzbequistão', 'Узбекистан', 'ウズベキスタン', 'UZ', 1),
(239, 'Vanuatu', 'Vanuatu', 'Vanuatu', 'Vanuatu', 'Vanuatu', 'Vanuatu', 'Вануату', 'バヌアツ', 'VU', 1),
(240, 'Vaticano', 'Vatican City', 'Vatikanstadt', 'Ciudad del Vaticano', 'État de la Cité du Vatican', 'Vaticano', 'Ватикан', 'バチカン市国', 'VA', 1),
(241, 'Venezuela', 'Venezuela', 'Venezuela', 'Venezuela', 'Venezuela', 'Venezuela', 'Венесуэла', 'ベネズエラ', 'VE', 1),
(242, 'Vietnam', 'Vietnam', 'Vietnam', 'Vietnam', 'Viêt Nam', 'Vietnã', 'Вьетнам', 'ベトナム', 'VN', 1),
(243, 'Wallis e Futuna', 'Wallis and Futuna', 'Wallis und Futuna', 'Wallis y Futuna', 'Wallis-et-Futuna', 'Wallis e Futuna', 'Уоллис и Футуна', 'ウォリス・フツナ', 'WF', 1),
(244, 'Yemen', 'Yemen', 'Jemen', 'Yemen', 'Yémen', 'Iêmen', 'Йемен', 'イエメン', 'YE', 1),
(245, 'Zambia', 'Zambia', 'Sambia', 'Zambia', 'Zambie', 'Zâmbia', 'Замбия', 'ザンビア', 'ZM', 1),
(246, 'Zimbabwe', 'Zimbabwe', 'Simbabwe', 'Zimbabue', 'Zimbabwe', 'Zimbábue', 'Зимбабве', 'ジンバブエ', 'ZW', 1),
(247, 'regione non valida o sconosciuta', 'Unknown or Invalid Region', 'Unbekannte oder ungültige Region', 'Región desconocida o no válida', 'région indéterminée', 'Região desconhecida ou inválida', 'Неизвестный или недействительный регион', '不明な地域', 'ZZ', 1);

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `location_nations`
--
ALTER TABLE `location_nations`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `location_nations`
--
ALTER TABLE `location_nations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=248;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
