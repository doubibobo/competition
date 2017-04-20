-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: 2017-04-16 23:44:51
-- 服务器版本： 5.6.35
-- PHP Version: 5.6.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `competition`
--

-- --------------------------------------------------------

--
-- 表的结构 `tp_device`
--

CREATE TABLE `tp_device` (
  `id` int(11) NOT NULL,
  `select_device` int(11) NOT NULL,
  `period` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `date` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `tp_information`
--

CREATE TABLE `tp_information` (
  `id` int(11) NOT NULL COMMENT '主键设置',
  `title` varchar(100) NOT NULL COMMENT '通知标题',
  `content` text NOT NULL COMMENT '通知内容',
  `date` date NOT NULL COMMENT '发表时间',
  `userid` int(11) NOT NULL COMMENT '发布人id'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `tp_information`
--

INSERT INTO `tp_information` (`id`, `title`, `content`, `date`, `userid`) VALUES
(13, '朱传波', '<p>他说你任何为人称道的美丽</p><p>不及他第一次遇见你</p><p>时光苟延残喘无可奈何</p><p>如果所有土地连在一起</p><p>走上一生只为拥抱你</p><p>喝醉了 他的梦 晚安</p><p>大梦初醒 荒唐了一生</p><p>---------------帅</p>', '2017-03-16', 111),
(15, 'Java课程设计', '<p style=\"text-align: center;\"><br/></p><p style=\"line-height: 16px; text-align: center;\"><img style=\"vertical-align: middle; margin-right: 2px;\" src=\"http://localhost:8080/competition/Public/Ueditor/dialogs/attachment/fileTypeImages/icon_jpg.gif\"/><a style=\"font-size:12px; color:#0066cc;\" href=\"/ueditor/php/upload/file/20170317/1489745150223223.png\" title=\"2016-12-24 01-42-28屏幕截图.png\">2016-12-24 01-42-28屏幕截图.png</a></p><p style=\"line-height: 16px; text-align: center;\"><img style=\"vertical-align: middle; margin-right: 2px;\" src=\"http://localhost:8080/competition/Public/Ueditor/dialogs/attachment/fileTypeImages/icon_rar.gif\"/><a style=\"font-size:12px; color:#0066cc;\" href=\"/ueditor/php/upload/file/20170317/1489745150508301.rar\" title=\"2016-2017-2学期双百案例选课通知.rar\">2016-2017-2学期双百案例选课通知.rar</a></p><p style=\"line-height: 16px; text-align: center;\"><img style=\"vertical-align: middle; margin-right: 2px;\" src=\"http://localhost:8080/competition/Public/Ueditor/dialogs/attachment/fileTypeImages/icon_xls.gif\"/><a style=\"font-size:12px; color:#0066cc;\" href=\"/ueditor/php/upload/file/20170317/1489745150107016.xls\" title=\"Excel测试(2017-02-24).xls\">Excel测试(2017-02-24).xls</a></p><p><br/></p>', '2017-03-17', 111),
(16, '中华人民共和国中央人民政府委员会', '<pre class=\"brush:cpp;toolbar:false\">#include&nbsp;&lt;iostream&gt;\nusing&nbsp;namespace&nbsp;std;\nint&nbsp;main()&nbsp;{\n&nbsp;&nbsp;&nbsp;&nbsp;cout&nbsp;&lt;&lt;&nbsp;&quot;Hello&nbsp;world!&quot;&nbsp;&lt;&lt;&nbsp;endl;\n&nbsp;&nbsp;&nbsp;&nbsp;return&nbsp;0;\n}</pre><p><br/></p>', '2017-03-18', 111);

-- --------------------------------------------------------

--
-- 表的结构 `tp_member`
--

CREATE TABLE `tp_member` (
  `id` int(11) NOT NULL COMMENT 'id',
  `name` varchar(255) NOT NULL COMMENT '姓名',
  `rules` varchar(1024) DEFAULT NULL COMMENT '值班规则',
  `limit_count` int(11) DEFAULT '-1' COMMENT '值班次数限制',
  `description` text COMMENT '其他信息',
  `createtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `phone` bigint(32) DEFAULT NULL COMMENT '电话号码',
  `email` varchar(100) DEFAULT NULL COMMENT '邮箱',
  `class1` varchar(100) DEFAULT NULL COMMENT '班级',
  `other` varchar(100) DEFAULT NULL COMMENT '类别'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `tp_member`
--

INSERT INTO `tp_member` (`id`, `name`, `rules`, `limit_count`, `description`, `createtime`, `phone`, `email`, `class1`, `other`) VALUES
(4, '刘晓磊', '12:00-17:00', 2, '', '2017-04-05 16:00:00', 15071267961, '3287662416@qq.com', '计算机1502', '预备党员'),
(29, '白天宇', '08:30-09:30', 2, '这是白天宇', '2017-03-17 16:00:00', 15071267961, 'doubibobolalala@gmail.com', '计算机1502', '群众'),
(30, '项健健', '10:30-13:30', 2, '哈哈哈', '2017-03-24 08:09:39', 13260558603, 'xiangjianjian@gmail.com', '计算机1502', '群众'),
(31, 'ctc', '08:30-09:00', 0, '', '2017-04-01 08:56:41', 18627121558, '847@qq.com', '1502', 'qunzhong');

-- --------------------------------------------------------

--
-- 表的结构 `tp_setted`
--

CREATE TABLE `tp_setted` (
  `id` int(11) NOT NULL COMMENT 'ID号',
  `period` varchar(100) NOT NULL COMMENT '值班时间段安排',
  `create_time` varchar(100) NOT NULL COMMENT '创建时间',
  `date` varchar(100) NOT NULL COMMENT '值班日期',
  `address` varchar(32) NOT NULL COMMENT '值班地点'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `tp_setted`
--

INSERT INTO `tp_setted` (`id`, `period`, `create_time`, `date`, `address`) VALUES
(4, '08:00-13:00', '2017-04-01 07:59:19', '2017-03-25', '护甲'),
(5, '08:00-13:00;14:30-17:00', '2017-04-01 08:22:02', '2017-03-25', '荟园十栋'),
(7, '17:00-18:00;19:00-21:00', '2017-04-06 04:44:47', '2017-03-10', '三教a520'),
(8, '17:00-18:00;19:00-21:00', '2017-04-06 04:45:21', '0000-00-00', '三教a520'),
(9, '17:00-18:00;19:00-21:00', '2017-04-06 06:19:28', '2017-03-10;2017-3-31', '荟十');

-- --------------------------------------------------------

--
-- 表的结构 `tp_user`
--

CREATE TABLE `tp_user` (
  `userid` bigint(20) NOT NULL COMMENT '用户ID号',
  `username` varchar(32) NOT NULL COMMENT '用户名',
  `useremail` varchar(32) NOT NULL COMMENT '邮箱',
  `userphone` varchar(32) NOT NULL COMMENT '电话号码',
  `realname` varchar(32) NOT NULL COMMENT '真实姓名',
  `create_time` date NOT NULL COMMENT '创建时间',
  `idadmin` smallint(6) NOT NULL DEFAULT '0' COMMENT '管理员否',
  `userpass` varchar(100) NOT NULL COMMENT '用户密码'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `tp_user`
--

INSERT INTO `tp_user` (`userid`, `username`, `useremail`, `userphone`, `realname`, `create_time`, `idadmin`, `userpass`) VALUES
(2015317200401, '项三六', 'xiangjianjian@gmail.com', '13260558603', '项健健', '2017-03-04', 0, '250cf8b51c773f3f8dc8b4be867a9a02'),
(2015317200402, '逗比波波', 'doubibobolalala@gmail.com', '17607183215', '朱传波', '2017-03-04', 0, '202cb962ac59075b964b07152d234b70'),
(2015317200403, 'doubibobo', '3287662416@qq.com', '17607183215', '逗比波波', '2017-03-10', 0, 'd41d8cd98f00b204e9800998ecf8427e'),
(2015317200404, 'hahaha', '3287662416@qq.com', '15071267961', '朱传波', '2017-03-10', 0, '202cb962ac59075b964b07152d234b70');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tp_device`
--
ALTER TABLE `tp_device`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tp_information`
--
ALTER TABLE `tp_information`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tp_member`
--
ALTER TABLE `tp_member`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `tp_setted`
--
ALTER TABLE `tp_setted`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tp_user`
--
ALTER TABLE `tp_user`
  ADD PRIMARY KEY (`userid`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `userid` (`userid`),
  ADD UNIQUE KEY `username_3` (`username`),
  ADD KEY `username_2` (`username`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `tp_device`
--
ALTER TABLE `tp_device`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `tp_information`
--
ALTER TABLE `tp_information`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键设置', AUTO_INCREMENT=17;
--
-- 使用表AUTO_INCREMENT `tp_member`
--
ALTER TABLE `tp_member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id', AUTO_INCREMENT=32;
--
-- 使用表AUTO_INCREMENT `tp_setted`
--
ALTER TABLE `tp_setted`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID号', AUTO_INCREMENT=10;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
