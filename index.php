<?php

require_once 'simple_pagination.php';
$pagination = new SimplePagination(10);
$pagination-> setTotalRecords(100);
echo $pagination-> renderBeautiful();
