-- 数据库中如果没有名称为shopImooc的库，就创建它
create database if not exists `shopImooc`;
-- 选择数据库shopImooc
use `shopImooc`;

-- 如果存在名称为imooc_admin的表格，就删除它
drop table if exists `imooc_admin`;
-- 管理员表
-- 创建名称为imooc_admin的表格
create table `imooc_admin`(    
    `id` tinyint unsigned auto_increment primary key,-- id设为不为负且自增长的主键
    `username` varchar(20) not null unique key,-- usename设为最多20个字符且不为空的唯一键
    `password` char(32) not null,-- password限制不为空，且最多32个字符
    `email` varchar(50) not null -- Email限制不为空，且最多50个字符
);

-- 分类表
drop table if exists `immooc_cate`;
create table `imooc_cate`(
    `id` tinyint unsigned auto_increment primary key,
    `cName` varchar(50) unique key    
);

-- 商品表
drop table if exists `immooc_pro`;
create table `imooc_pro`(
    `id`int unsigned auto_increment primary key,
    `pName` varchar(50) not null unique key,
    `pSn` varchar(50) not null,
    `pNum` int unsigned default 1,
    `mPrice` decimal(10,2) not null,
    `iPrice` decimal(10,2) not null,
    `pDesc` text,
    `pIng` varchar(50) not null,
    `pubTime` int unsigned null null,
    `isShow` tinyint(1) default 1,
    `isHot` tinyint(1) default 0,
    `cId` smallint unsigned not null  
);

-- 用户表
drop table if exists `imooc_user`;
create table `imooc_user`(
    `id` int unsigned auto_increment primary key,
    `username` varchar(20) not null unique key,
    `password` char(32) not null,
    `sex` enum("男","女","保密") not null default "保密",
    `face` varchar(50) not null,
    `regTime` int unsigned not null
);

-- 相册表
drop table if exists `imooc_album`;
create table `imooc_album`(
    `id` int unsigned auto_increment primary key,
    `pid` int unsigned not null,
    `albumPath` varchar(50) not null
);