-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 2024-02-04 06:28:19
-- サーバのバージョン： 10.4.32-MariaDB
-- PHP のバージョン: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `gs_db4`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `gs_bm_table`
--

CREATE TABLE `gs_bm_table` (
  `id` int(12) NOT NULL,
  `bookname` varchar(64) NOT NULL,
  `author` varchar(64) DEFAULT NULL,
  `bookurl` text DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `category` varchar(64) DEFAULT NULL,
  `star` tinyint(1) DEFAULT NULL,
  `indate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `gs_bm_table`
--

INSERT INTO `gs_bm_table` (`id`, `bookname`, `author`, `bookurl`, `comment`, `category`, `star`, `indate`) VALUES
(1, 'がらんどう', '大谷　朝子', 'https://www.amazon.co.jp/%E3%81%8C%E3%82%89%E3%82%93%E3%81%A9%E3%81%86-%E5%A4%A7%E8%B0%B7-%E6%9C%9D%E5%AD%90/dp/408771828X', 'ジェンヌ初出版！！', '小説', 5, '2024-02-04 13:15:49'),
(2, '夏物語', '川上　未映子', 'https://www.amazon.co.jp/%E5%A4%8F%E7%89%A9%E8%AA%9E-%E5%B7%9D%E4%B8%8A-%E6%9C%AA%E6%98%A0%E5%AD%90/dp/4163910549', '考えさせられる', '小説', 4, '2024-01-20 16:50:24'),
(3, '運命を拓く', '中村　天風', 'https://www.amazon.co.jp/%E9%81%8B%E5%91%BD%E3%82%92%E6%8B%93%E3%81%8F-%E8%AC%9B%E8%AB%87%E7%A4%BE%E6%96%87%E5%BA%AB-%E4%B8%AD%E6%9D%91-%E5%A4%A9%E9%A2%A8/dp/4062637391/ref=sr_1_1?adgrpid=148752444176&hvadid=679004908729&hvdev=c&hvlocphy=1009341&hvnetw=g&hvqmt=b&hvrand=15108398961533920680&hvtargid=kwd-2116197778517&hydadcr=4073_13378617&jp-ad-ap=0&keywords=%E4%B8%AD%E6%9D%91%E5%A4%A9%E9%A2%A8+%E9%81%8B%E5%91%BD%E3%82%92%E6%8B%93%E3%81%8F&qid=1705737074&sr=8-1', '丹田を鍛える', '哲学書', 5, '2024-01-20 16:53:41'),
(4, 'はてしない物語', 'ミヒャエル・エンデ', 'https://www.amazon.co.jp/%E3%81%AF%E3%81%A6%E3%81%97%E3%81%AA%E3%81%84%E7%89%A9%E8%AA%9E-%E3%82%A8%E3%83%B3%E3%83%87%E3%81%AE%E5%82%91%E4%BD%9C%E3%83%95%E3%82%A1%E3%83%B3%E3%82%BF%E3%82%B8%E3%83%BC-%E3%83%9F%E3%83%92%E3%83%A3%E3%82%A8%E3%83%AB%E3%83%BB%E3%82%A8%E3%83%B3%E3%83%87/dp/4001109816', '永遠のファンタジー', '小説', 5, '2024-01-20 16:55:27'),
(5, 'ヨーロッパ退屈日記', '伊丹 十三 ', 'https://www.amazon.co.jp/%E3%83%A8%E3%83%BC%E3%83%AD%E3%83%83%E3%83%91%E9%80%80%E5%B1%88%E6%97%A5%E8%A8%98-%E6%96%B0%E6%BD%AE%E6%96%87%E5%BA%AB-%E4%BC%8A%E4%B8%B9-%E5%8D%81%E4%B8%89/dp/4101167311/ref=sr_1_1?__mk_ja_JP=%E3%82%AB%E3%82%BF%E3%82%AB%E3%83%8A&crid=2RRRPY24YSROV&keywords=%E3%83%A8%E3%83%BC%E3%83%AD%E3%83%83%E3%83%91%E9%80%80%E5%B1%88%E6%97%A5%E8%A8%98&qid=1705737460&s=books&sprefix=%E3%83%A8%E3%83%BC%E3%83%AD%E3%83%83%E3%83%91%E9%80%80%E5%B1%88%E6%97%A5%E8%A8%98%2Cstripbooks%2C155&sr=1-1', 'イケオジの食べログ', 'エッセイ', 5, '2024-02-04 11:30:18');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `gs_bm_table`
--
ALTER TABLE `gs_bm_table`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `gs_bm_table`
--
ALTER TABLE `gs_bm_table`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
