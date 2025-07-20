<?php

// 分页的核心思想：
// 	1. 计算总页数 = ceil($total /每页显示数)
// 	2. 计算偏移量 = （当前页 - 1 ） * 每页显示数
// 	3. 使用SQL的LIMIT 和 OFFSET 进行分页查询


class LryPagination{
	private $totalRecords = 0; //总记录数
	private $recordsPerPage = 10; //每页显示记录数目
	private $totalPages = 0;
	private $currentPage = 1 ;
	private $offset = 0;

	



}