-- Table structure for table `tbl_user`

CREATE TABLE `tbl_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `user_type` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `user_ip` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `verify_password` int(11) NOT NULL,
  `time_log` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Primary key for table `tbl_user`
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id`);
-- --------------------------------------------------------
-- Table structure for table `tbl_student`

CREATE TABLE `tbl_student` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `studentId` int(11) NOT NULL,
  `firstName` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `lastName` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `photo` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `classId` int(11) NOT NULL,
  `phone` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Primary key for table `tbl_user`
ALTER TABLE `tbl_student`
  ADD PRIMARY KEY (`id`);
-- --------------------------------------------------------
-- Table structure for table `tbl_class`

CREATE TABLE `tbl_class` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `className` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Primary key for table `tbl_user`
ALTER TABLE `tbl_class`
  ADD PRIMARY KEY (`id`);
-- --------------------------------------------------------
-- Table structure for table `tbl_category`

CREATE TABLE `tbl_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categoryName` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Primary key for table `tbl_user`
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`id`);
-- --------------------------------------------------------
-- Table structure for table `tbl_author`

CREATE TABLE `tbl_author` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `authorName` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Primary key for table `tbl_user`
ALTER TABLE `tbl_author`
  ADD PRIMARY KEY (`id`);
-- --------------------------------------------------------
-- Table structure for table `tbl_book`

CREATE TABLE `tbl_book` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `categoryId` int(11) NOT NULL,
  `authorId` int(11) NOT NULL,
  `status` enum('Available','Unavailable') COLLATE utf8_unicode_ci NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Primary key for table `tbl_user`
ALTER TABLE `tbl_book`
  ADD PRIMARY KEY (`id`);
-- --------------------------------------------------------
-- Table structure for table `tbl_borrow`

CREATE TABLE `tbl_borrow` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bookId` int(11) NOT NULL,
  `studentId` int(11) NOT NULL,
  `date_borrow` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `expected_return_date` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `return_date` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('','Return','Not Return') COLLATE utf8_unicode_ci NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Primary key for table `tbl_user`
ALTER TABLE `tbl_borrow`
  ADD PRIMARY KEY (`id`);
-- --------------------------------------------------------