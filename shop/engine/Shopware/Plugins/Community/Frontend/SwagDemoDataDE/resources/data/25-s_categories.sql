INSERT IGNORE INTO `s_categories` (`id`, `parent`, `path`, `description`, `position`, `left`, `right`, `level`, `added`, `changed`, `metakeywords`, `metadescription`, `cmsheadline`, `cmstext`, `template`, `active`, `blog`, `external`, `hidefilter`, `hidetop`, `mediaID`, `product_box_layout`, `meta_title`, `stream_id`) VALUES
('1', NULL, NULL, 'Root', '0', '1', '6', '0', '2012-08-27 22:28:52', '2012-08-27 22:28:52', NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '0', '0', '0', NULL, NULL, NULL),
('3', '1', NULL, 'Deutsch', '0', '2', '3', '1', '2012-08-27 22:28:52', '2012-08-27 22:28:52', NULL, '', '', '', NULL, '1', '0', '', '0', '0', NULL, NULL, NULL, NULL),
('4', '1', NULL, 'Englisch', '1', '4', '5', '1', '2012-08-27 22:28:52', '2012-08-27 22:28:52', NULL, '', '', '', NULL, '1', '0', '', '0', '0', NULL, NULL, NULL, NULL),
('5', '3', '|3|', 'Höhenluft & Abenteuer', '0', '0', '0', '0', '2015-01-25 20:59:28', '2015-01-25 20:59:28', NULL, '', '', '', NULL, '1', '0', '', '0', '0', NULL, 'minimal', NULL, NULL),
('6', '3', '|3|', 'Kochlust & Provence', '1', '0', '0', '0', '2015-01-25 20:59:36', '2015-01-25 20:59:36', NULL, '', '', '', NULL, '1', '0', '', '0', '0', NULL, 'basic', NULL, NULL),
('7', '3', '|3|', 'Handwerk & Tradition', '2', '0', '0', '0', '2015-01-25 20:59:57', '2015-01-25 20:59:57', NULL, '', '', '', NULL, '1', '0', '', '0', '0', NULL, 'image', NULL, NULL),
('8', '5', '|5|3|', 'Ausrüstung', NULL, '0', '0', '0', '2015-01-25 21:00:53', '2015-01-25 21:00:53', NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '0', '0', NULL, NULL, NULL, NULL),
('9', '5', '|5|3|', 'Fashion', NULL, '0', '0', '0', '2015-01-25 21:01:07', '2015-01-25 21:01:07', NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '0', '0', NULL, NULL, NULL, NULL),
('10', '8', '|8|5|3|', 'Ski', NULL, '0', '0', '0', '2015-01-25 21:04:05', '2015-01-25 21:04:05', NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '0', '0', NULL, NULL, NULL, NULL),
('11', '8', '|8|5|3|', 'Snowboard', NULL, '0', '0', '0', '2015-01-25 21:04:13', '2015-01-25 21:04:13', NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '0', '0', NULL, NULL, NULL, NULL),
('12', '8', '|8|5|3|', 'Zubehör', NULL, '0', '0', '0', '2015-01-25 21:04:30', '2015-01-25 21:04:30', NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '0', '0', NULL, NULL, NULL, NULL),
('13', '12', '|12|8|5|3|', 'Stöcke', '1', '0', '0', '0', '2015-01-25 21:04:41', '2015-01-25 21:04:41', NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '0', '0', NULL, NULL, NULL, NULL),
('14', '12', '|12|8|5|3|', 'Handschuhe', '2', '0', '0', '0', '2015-01-25 21:04:49', '2015-01-25 21:04:49', NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '0', '0', NULL, NULL, NULL, NULL),
('15', '12', '|12|8|5|3|', 'Rücksäcke', '3', '0', '0', '0', '2015-01-25 21:04:56', '2015-01-25 21:04:56', NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '0', '0', NULL, NULL, NULL, NULL),
('16', '9', '|9|5|3|', 'Damen', NULL, '0', '0', '0', '2015-01-25 21:05:10', '2015-01-25 21:05:10', NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '0', '0', NULL, NULL, NULL, NULL),
('17', '9', '|9|5|3|', 'Herren', NULL, '0', '0', '0', '2015-01-25 21:05:18', '2015-01-25 21:05:18', NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '0', '0', NULL, NULL, NULL, NULL),
('18', '6', '|6|3|', 'Essen', NULL, '0', '0', '0', '2015-01-25 21:05:34', '2015-01-25 21:05:34', NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '0', '0', NULL, NULL, NULL, NULL),
('19', '6', '|6|3|', 'Trinken', NULL, '0', '0', '0', '2015-01-25 21:05:42', '2015-01-25 21:05:42', NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '0', '0', NULL, NULL, NULL, NULL),
('20', '18', '|18|6|3|', 'Fisch', NULL, '0', '0', '0', '2015-01-25 21:05:54', '2015-01-25 21:05:54', NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '0', '0', NULL, NULL, NULL, NULL),
('21', '18', '|18|6|3|', 'Öle & Gewürze', NULL, '0', '0', '0', '2015-01-25 21:06:04', '2015-01-25 21:06:04', NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '0', '0', NULL, NULL, NULL, NULL),
('22', '18', '|18|6|3|', 'Süßes', NULL, '0', '0', '0', '2015-01-25 21:06:11', '2015-01-25 21:06:11', NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '0', '0', NULL, NULL, NULL, NULL),
('23', '21', '|21|18|6|3|', 'Essig & Öl', NULL, '0', '0', '0', '2015-01-25 21:06:35', '2015-01-25 21:06:35', NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '0', '0', NULL, NULL, NULL, NULL),
('24', '21', '|21|18|6|3|', 'Gewürze', NULL, '0', '0', '0', '2015-01-25 21:06:46', '2015-01-25 21:06:46', NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '0', '0', NULL, NULL, NULL, NULL),
('25', '19', '|19|6|3|', 'Edelbrände', NULL, '0', '0', '0', '2015-01-25 21:07:07', '2015-01-25 21:07:07', NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '0', '0', NULL, NULL, NULL, NULL),
('26', '19', '|19|6|3|', 'Kaffee', NULL, '0', '0', '0', '2015-01-25 21:07:14', '2015-01-25 21:07:14', NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '0', '0', NULL, NULL, NULL, NULL),
('27', '7', '|7|3|', 'Damen', NULL, '0', '0', '0', '2015-01-25 21:07:26', '2015-01-25 21:07:26', NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '0', '0', NULL, NULL, NULL, NULL),
('28', '7', '|7|3|', 'Herren', NULL, '0', '0', '0', '2015-01-25 21:07:33', '2015-01-25 21:07:33', NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '0', '0', NULL, NULL, NULL, NULL),
('29', '27', '|27|7|3|', 'Handtaschen', NULL, '0', '0', '0', '2015-01-25 21:07:43', '2015-01-25 21:07:43', NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '0', '0', NULL, NULL, NULL, NULL),
('30', '27', '|27|7|3|', 'Businesstaschen', NULL, '0', '0', '0', '2015-01-25 21:07:52', '2015-01-25 21:07:52', NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '0', '0', NULL, NULL, NULL, NULL),
('31', '27', '|27|7|3|', 'Geldbörsen & Brieftaschen', NULL, '0', '0', '0', '2015-01-25 21:08:07', '2015-01-25 21:08:07', NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '0', '0', NULL, NULL, NULL, NULL),
('33', '28', '|28|7|3|', 'Businesstaschen', NULL, '0', '0', '0', '2015-01-25 21:08:45', '2015-01-25 21:08:45', NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '0', '0', NULL, NULL, NULL, NULL),
('35', '12', '|12|8|5|3|', 'Bindungen', '0', '0', '0', '0', '2015-01-26 18:08:54', '2015-01-26 18:08:54', NULL, NULL, NULL, NULL, NULL, '1', '0', NULL, '0', '0', NULL, NULL, NULL, NULL),
('37', '3', '|3|', 'Blog', '4', '0', '0', '0', '2015-03-09 14:52:05', '2015-03-09 14:52:05', NULL, '', '', '', NULL, '1', '1', '', '0', '0', NULL, NULL, NULL, NULL);
