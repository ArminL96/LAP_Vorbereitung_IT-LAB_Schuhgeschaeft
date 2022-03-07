-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 07. Mrz 2022 um 09:10
-- Server-Version: 10.4.22-MariaDB
-- PHP-Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `shoeshop`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `billingadress`
--

CREATE TABLE `billingadress` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `adress` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `zipcode` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `category`
--

CREATE TABLE `category` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `Name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `cartId` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cartId` bigint(20) UNSIGNED NOT NULL,
  `customerId` bigint(20) UNSIGNED NOT NULL,
  `billAddId` bigint(20) UNSIGNED NOT NULL,
  `shipAddId` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `categoryId` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `returns`
--

CREATE TABLE `returns` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `orderId` bigint(20) UNSIGNED NOT NULL,
  `returned` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `shippingadress`
--

CREATE TABLE `shippingadress` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `adress` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `zipcode` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `shopingcart`
--

CREATE TABLE `shopingcart` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `totalPrice` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
-- Indizes für die Tabelle `customer`
--
ALTER TABLE `customer`
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `user_id` (`userId`),
  ADD KEY `shippingAdd_id` (`shippingAddressId`),
  ADD KEY `billingAdd_id` (`billingAdressId`),
  ADD KEY `cart_id` (`cartId`);

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `cartitem`
--
ALTER TABLE `cartitem`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `category`
--
ALTER TABLE `category`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `customer`
--
ALTER TABLE `customer`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `product`
--
ALTER TABLE `product`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `returns`
--
ALTER TABLE `returns`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `shippingadress`
--
ALTER TABLE `shippingadress`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `shopingcart`
--
ALTER TABLE `shopingcart`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `user`
--
ALTER TABLE `user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

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
