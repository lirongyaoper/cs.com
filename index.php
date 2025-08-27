<?php
include './data/data.php';
include './tree/tree.class.php';
include './tool/print.php';

$tree = new tree();
$tree ->init($categories);
$myid = '7';
$parentarr = $tree->get_parent($myid);
Palry($parentarr);

