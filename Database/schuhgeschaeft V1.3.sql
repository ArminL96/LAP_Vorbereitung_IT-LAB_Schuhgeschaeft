-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 05. Apr 2022 um 15:04
-- Server-Version: 10.4.21-MariaDB
-- PHP-Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `schuhgeschaeft`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `billingadress`
--

CREATE TABLE `billingadress` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `bill_adress` varchar(255) NOT NULL,
  `bill_country` varchar(255) NOT NULL,
  `bill_city` varchar(255) NOT NULL,
  `bill_zipcode` int(11) NOT NULL,
  `bill_firstName` varchar(32) NOT NULL,
  `bill_lastName` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `billingadress`
--

INSERT INTO `billingadress` (`id`, `bill_adress`, `bill_country`, `bill_city`, `bill_zipcode`, `bill_firstName`, `bill_lastName`) VALUES
(1, 'dfsdfggfdf', 'Germany', 'sggsdgfdgsf', 555, 'fdgssfg', 'fdddfgf'),
(2, 'Hauptstraße', 'Austria', 'Klagenfurt', 9020, 'test1', 'test23');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `cartitem`
--

CREATE TABLE `cartitem` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` float NOT NULL,
  `cartId` bigint(20) UNSIGNED NOT NULL,
  `productId` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `cartitem`
--

INSERT INTO `cartitem` (`id`, `quantity`, `price`, `cartId`, `productId`) VALUES
(394, 1, 1, 2, 1),
(395, 1, 1, 2, 2),
(396, 1, 1, 2, 3),
(397, 1, 1, 2, 4),
(398, 1, 1, 2, 5),
(399, 1, 1, 2, 10),
(400, 1, 1, 2, 11),
(401, 1, 1, 113, 3),
(402, 1, 1, 114, 3),
(403, 1, 1, 115, 3),
(404, 1, 1, 116, 3),
(405, 1, 1, 117, 4),
(414, 1, 1, 118, 3),
(415, 1, 1, 119, 3);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `category`
--

CREATE TABLE `category` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `Name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `category`
--

INSERT INTO `category` (`id`, `Name`) VALUES
(1, 'Herren'),
(2, 'Damen'),
(3, 'Kinder');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `creditcart`
--

CREATE TABLE `creditcart` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cardnumber` varchar(255) DEFAULT NULL,
  `expiredate` date DEFAULT NULL,
  `securitycode` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `creditcart`
--

INSERT INTO `creditcart` (`id`, `cardnumber`, `expiredate`, `securitycode`) VALUES
(1, 'AT41 1941 3432 1715 9221', '2026-08-04', 4516),
(2, '', '0000-00-00', 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `customer`
--

CREATE TABLE `customer` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `shippingAddressId` bigint(20) UNSIGNED NOT NULL,
  `billingAdressId` bigint(20) UNSIGNED NOT NULL,
  `userId` bigint(20) UNSIGNED NOT NULL,
  `cartId` bigint(20) UNSIGNED NOT NULL,
  `creditId` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `customer`
--

INSERT INTO `customer` (`id`, `firstName`, `lastName`, `shippingAddressId`, `billingAdressId`, `userId`, `cartId`, `creditId`) VALUES
(1, 'Keanu', 'Griesser', 1, 1, 1, 1, 1),
(2, 'test', 'test', 2, 2, 2, 119, 2);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cartId` bigint(20) UNSIGNED NOT NULL,
  `customerId` bigint(20) UNSIGNED NOT NULL,
  `billAddId` bigint(20) UNSIGNED NOT NULL,
  `shipAddId` bigint(20) UNSIGNED NOT NULL,
  `paymentMethod` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `orders`
--

INSERT INTO `orders` (`id`, `cartId`, `customerId`, `billAddId`, `shipAddId`, `paymentMethod`) VALUES
(1, 1, 1, 1, 1, 'card'),
(153, 2, 2, 2, 2, 'cash'),
(154, 113, 2, 2, 2, 'card'),
(155, 114, 2, 2, 2, 'cash'),
(156, 115, 2, 2, 2, 'card'),
(157, 116, 2, 2, 2, 'card'),
(158, 117, 2, 2, 2, 'card'),
(159, 118, 2, 2, 2, 'cash');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `product`
--

CREATE TABLE `product` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` float NOT NULL,
  `size` int(11) NOT NULL,
  `color` varchar(255) NOT NULL,
  `categoryId` bigint(20) UNSIGNED NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `product`
--

INSERT INTO `product` (`id`, `name`, `price`, `size`, `color`, `categoryId`, `description`) VALUES
(1, 'Scout Gummistiefel', 22.5, 23, 'Weiß', 3, 'Blaue Kinder Gummistiefel'),
(2, 'City Walk Stiefel', 69.8, 40, 'Schwarz', 2, 'Dunkelblaue Damen Stiefel auf Kniehöhe'),
(3, 'Herren Sneaker', 19.6, 45, 'Olivgrün', 1, 'Braune Herren Sneaker'),
(4, 'Hirschkogel Pumps', 74.5, 38, 'Schwarz', 2, 'Schwarze Damen Stöckelschuhe'),
(5, 'Sketchers Kids Sneaker', 30.2, 21, 'Schwarz', 3, 'Pinke Sketchers Sneaker'),
(10, 'Puma Sneaker', 50.6, 46, 'Braun', 1, 'Schwarze Sneaker Puma'),
(11, 'Birkenstock Pantolette', 10, 40, 'schwarz', 1, 'Braun und schwarze Pantoletten');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `returns`
--

CREATE TABLE `returns` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `orderId` bigint(20) UNSIGNED NOT NULL,
  `reason` varchar(255) NOT NULL,
  `returned` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `returns`
--

INSERT INTO `returns` (`id`, `orderId`, `reason`, `returned`) VALUES
(13, 1, '', 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `shippingadress`
--

CREATE TABLE `shippingadress` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ship_adress` varchar(32) NOT NULL,
  `ship_country` varchar(32) NOT NULL,
  `ship_city` varchar(32) NOT NULL,
  `ship_zipcode` int(11) NOT NULL,
  `ship_firstName` varchar(32) NOT NULL,
  `ship_lastName` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `shippingadress`
--

INSERT INTO `shippingadress` (`id`, `ship_adress`, `ship_country`, `ship_city`, `ship_zipcode`, `ship_firstName`, `ship_lastName`) VALUES
(1, 'gdfgdgfdg', 'Austria', 'dfggfdfgdfg', 66654, 'dfgfag', 'ggsgs'),
(2, 'Bahnhofstraße', 'Austria', 'Villach', 9020, 'test', 'test2');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `shopingcart`
--

CREATE TABLE `shopingcart` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `totalPrice` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `shopingcart`
--

INSERT INTO `shopingcart` (`id`, `totalPrice`) VALUES
(1, 0),
(2, 332.64),
(113, 23.52),
(114, 23.52),
(115, 23.52),
(116, 23.52),
(117, 89.4),
(118, 23.52),
(119, 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user`
--

CREATE TABLE `user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `userName` varchar(255) NOT NULL,
  `passwort` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `user`
--

INSERT INTO `user` (`id`, `userName`, `passwort`) VALUES
(1, 'User1', '$2y$10$wE/l7PgAT011QVI8HtQMq.qWCNpUzgV44n.FveGKFm6q9X4uNbyWW'),
(2, 'test1', '$2y$10$/NtW5QFaoZOX7TTAJGCQEO8A3txw.E5YteZNjLsP2cU5Md42P3zBa');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `billingadress`
--
ALTER TABLE `billingadress`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indizes für die Tabelle `cartitem`
--
ALTER TABLE `cartitem`
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `cart_cartitem_id` (`cartId`),
  ADD KEY `product_cartitem_id` (`productId`);

--
-- Indizes für die Tabelle `category`
--
ALTER TABLE `category`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indizes für die Tabelle `creditcart`
--
ALTER TABLE `creditcart`
  ADD UNIQUE KEY `id` (`id`) USING BTREE;

--
-- Indizes für die Tabelle `customer`
--
ALTER TABLE `customer`
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `user_id` (`userId`),
  ADD KEY `shippingAdd_id` (`shippingAddressId`),
  ADD KEY `billingAdd_id` (`billingAdressId`),
  ADD KEY `cart_id` (`cartId`),
  ADD KEY `credit_id` (`creditId`);

--
-- Indizes für die Tabelle `orders`
--
ALTER TABLE `orders`
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `customer_id` (`customerId`),
  ADD KEY `order_cart_id` (`cartId`),
  ADD KEY `order_billingAdd_id` (`billAddId`),
  ADD KEY `order_shippingAdd_id` (`shipAddId`);

--
-- Indizes für die Tabelle `product`
--
ALTER TABLE `product`
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `category_product_id` (`categoryId`);

--
-- Indizes für die Tabelle `returns`
--
ALTER TABLE `returns`
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `orderId` (`orderId`),
  ADD KEY `order_return_id` (`orderId`);

--
-- Indizes für die Tabelle `shippingadress`
--
ALTER TABLE `shippingadress`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indizes für die Tabelle `shopingcart`
--
ALTER TABLE `shopingcart`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indizes für die Tabelle `user`
--
ALTER TABLE `user`
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `billingadress`
--
ALTER TABLE `billingadress`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT für Tabelle `cartitem`
--
ALTER TABLE `cartitem`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=416;

--
-- AUTO_INCREMENT für Tabelle `category`
--
ALTER TABLE `category`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT für Tabelle `creditcart`
--
ALTER TABLE `creditcart`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT für Tabelle `customer`
--
ALTER TABLE `customer`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT für Tabelle `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=160;

--
-- AUTO_INCREMENT für Tabelle `product`
--
ALTER TABLE `product`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT für Tabelle `returns`
--
ALTER TABLE `returns`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT für Tabelle `shippingadress`
--
ALTER TABLE `shippingadress`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT für Tabelle `shopingcart`
--
ALTER TABLE `shopingcart`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- AUTO_INCREMENT für Tabelle `user`
--
ALTER TABLE `user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `cartitem`
--
ALTER TABLE `cartitem`
  ADD CONSTRAINT `cart_cartitem_id` FOREIGN KEY (`cartId`) REFERENCES `shopingcart` (`id`),
  ADD CONSTRAINT `product_cartitem_id` FOREIGN KEY (`productId`) REFERENCES `product` (`id`);

--
-- Constraints der Tabelle `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `billingAdd_id` FOREIGN KEY (`billingAdressId`) REFERENCES `billingadress` (`id`),
  ADD CONSTRAINT `cart_id` FOREIGN KEY (`cartId`) REFERENCES `shopingcart` (`id`),
  ADD CONSTRAINT `credit_id` FOREIGN KEY (`creditId`) REFERENCES `creditcart` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `shippingAdd_id` FOREIGN KEY (`shippingAddressId`) REFERENCES `shippingadress` (`id`),
  ADD CONSTRAINT `user_id` FOREIGN KEY (`userId`) REFERENCES `user` (`id`);

--
-- Constraints der Tabelle `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `customer_id` FOREIGN KEY (`customerId`) REFERENCES `customer` (`id`),
  ADD CONSTRAINT `order_billingAdd_id` FOREIGN KEY (`billAddId`) REFERENCES `billingadress` (`id`),
  ADD CONSTRAINT `order_cart_id` FOREIGN KEY (`cartId`) REFERENCES `shopingcart` (`id`),
  ADD CONSTRAINT `order_shippingAdd_id` FOREIGN KEY (`shipAddId`) REFERENCES `shippingadress` (`id`);

--
-- Constraints der Tabelle `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `category_product_id` FOREIGN KEY (`categoryId`) REFERENCES `category` (`id`);

--
-- Constraints der Tabelle `returns`
--
ALTER TABLE `returns`
  ADD CONSTRAINT `order_return_id` FOREIGN KEY (`orderId`) REFERENCES `orders` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
