-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 27, 2020 at 09:51 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bidding_db`
--

-- --------------------------------------------------------

CREATE TABLE `auction_log` (
  `farmer_id` BIGINT NOT NULL,
  `number` BIGINT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `auction_log`
  ADD PRIMARY KEY (`farmer_id`);

INSERT INTO `auction_log` (`farmer_id`, `number`) VALUES
(1234567891234567, 9999988888);


--
-- Table structure for table `bids`
--

CREATE TABLE `bids` (
  `id` int(30) NOT NULL,
  `user_id` int(30) NOT NULL,
  `product_id` int(30) NOT NULL,
  `bid_amount` float NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=bid,2=confirmed,3=cancelled',
  `date_created` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `seller_id` BIGINT(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bids`
--

INSERT INTO `bids` (`id`, `user_id`, `product_id`, `bid_amount`, `status`, `date_created`, `seller_id`) VALUES
(2, 5, 1, 7500, 1, '2020-10-27 14:18:50', 0),
(4, 5, 3, 155000, 1, '2020-10-27 16:37:29', 0);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(30) NOT NULL,
  `name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Sample Category'),
(2, 'Appliances'),
(3, 'Desktop Computers'),
(4, 'Laptop'),
(5, 'Mobile Phone');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(30) NOT NULL,
  `contact` BIGINT(20) NOT NULL,
  `address` TEXT NOT NULL,
  `username` VARCHAR(200) NOT NULL,
  `category_id` int(30) NOT NULL,
  `name` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `start_bid` float NOT NULL,
  `regular_price` float NOT NULL,
  `bid_end_datetime` datetime NOT NULL,
  `img_fname` text NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `buyer_id` BIGINT(20) NOT NULL,
  `seller_authId` BIGINT(20) NOT NULL,
  `bid_amt` BIGINT(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `description`, `start_bid`, `regular_price`, `bid_end_datetime`, `img_fname`, `date_created`, `buyer_id`, `seller_authId`, `bid_amt`) VALUES
(1, 5, 'Sample Smart Phone', 'Sample only', 7000, 7000, '2020-10-27 19:00:00', '1.jpg', '2020-10-27 09:50:54',0 ,0 ,0),
(3, 1, 'Gadget Package', 'Sample ', 150000, 15000, '2020-10-27 17:00:00', '3.jpg', '2020-10-27 09:59:39',0,0,0);

-- --------------------------------------------------------

--
-- Table structure for table `system_settings`
--

CREATE TABLE `system_settings` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL,
  `email` varchar(200) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `cover_img` text NOT NULL,
  `about_content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `system_settings`
--

INSERT INTO `system_settings` (`id`, `name`, `email`, `contact`, `cover_img`, `about_content`) VALUES
(1, 'Bid.it', 'hello@srivarshan.org', '+91 8870408316', '1603344720_1602738120_pngtree-purple-hd-business-banner-image_5493.jpg', 'Welcome to [ Bid.it ], the ultimate online bidding platform designed exclusively for farmers, revolutionizing the way agricultural products are brought from the fields to your table. Our platform is a game-changer, facilitating direct transactions between farmers and consumers, eradicating middleman fees that often cut into the hard-earned profits of our diligent farmers. In a world of rapid digital transformation, we stand as a beacon of change, empowering farmers and rejuvenating local economies.At the heart of our ethos lies a commitment to empowering the backbone of our society: farmers. We understand the toil and dedication that goes into cultivating the finest produce, and thus, we  engineered a platform that dismantles traditional supply chains, allowing farmers to market and sell their products directly to consumers. This approach not only secures better financial returns for farmers but also fosters a deeper connection between the people who grow our food and the people who consume it.Gone are the days of uncertainty and inequity. On [ Bid.it ], farmers take the reins, listing their products and setting initial bids, which prospective buyers can then engage with through a real-time bidding process. This dynamic system ensures fair pricing, transparent transactions, and an engaging shopping experience that brings the farm-to-table concept closer than ever before.Our platform isn't just a transactional space; it's a bridge between two worlds. Urban customers seeking fresh, organic produce can now establish a direct line to rural farmers who pour their passion into every seed sown. By bypassing intermediaries, consumers get access to high-quality, locally-sourced goods, while farmers can bask in the recognition and value they truly deserve.Here at [ Bid.it ], our vision extends beyond just profit margins. We on a mission to catalyze a movement towards sustainable agriculture, celebrating the eco-friendly methods that ensure the longevity of our planet. Through our platform, farmers are encouraged to adopt responsible practices that nurture the soil, conserve resources, and protect biodiversity.Our community thrives on collaboration, fostering an environment where farmers can connect, share insights, and uplift each other. We're more than just a transactional space; we're a hub for learning, growth, and innovation. Our blog is a treasure trove of wisdom, with articles that delve into the intricacies of modern farming, technological advancements, and inspiring success stories.Every click and bid on our platform is a testament to a brighter future for agriculture. With every transaction, we inch closer to our goal of reducing the economic disparity that often plagues the farming community. By eliminating intermediaries, we ensure that the lion share of the profits remains where it rightfully belongs—with the farmers themselves.As you navigate through our about page, you'll encounter stories of farmers who've thrived in our ecosystem, transcending geographical barriers to find loyal customers who appreciate their hard work. These stories serve as a testament to the impact of [Website Name], not just as a platform but as a movement that reimagines the future of food commerce.Join us in this journey of transformation. Become a part of the [Website Name] community, where innovation meets tradition, and progress meets sustainability. As you explore our offerings, remember that every bid you place, every purchase you make, is a vote for a world where farmers flourish, and every meal comes with a story worth savoring.');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` text NOT NULL,
  `email` varchar(200) NOT NULL,
  `contact` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 2 COMMENT '1=Admin,2=Subscriber',
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `email`, `contact`, `address`, `type`, `date_created`) VALUES
(1, 'Administrator', 'admin', '0192023a7bbd73250516f069df18b500', 'admin@admin.com', '+123456789', '', 1, '2020-10-27 09:19:59'),
(5, 'John Smith', 'jsmith', '1254737c076cf867dc53d60a0364f38e', 'jsmith@sample.com', '+18456-5455-55', 'Sample', 2, '2020-10-27 14:18:32');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bids`
--
ALTER TABLE `bids`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_settings`
--
ALTER TABLE `system_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bids`
--
ALTER TABLE `bids`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `system_settings`
--
ALTER TABLE `system_settings`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
