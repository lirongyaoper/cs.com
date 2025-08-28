<?php
include './data/treedata.php';
include './tree/tree.class.php';
include './tool/print.php';

// $tree = new tree();
// $tree ->init($categories);
// $myid = '7';
// $parentarr = $tree->get_parent($myid);



// function get_parent($myid){
//     $newarr = array();
//     if(!isset($this->arr[$myid])) return false;
//     $pid = $this->arr[$myid]['parentid']; // 先获取当前节点的父ID
//     $pid = $this->arr[$pid]['parentid']; // 再获取父节点的父ID（祖父ID）
//     foreach($this->arr as $id => $a){
//         if($a['parentid'] == $pid) $newarr[$id] = $a; // 找祖父的所有子节点（即父节点的兄弟）
//     }
//     return $newarr;
//

// function get_parent($treeData){
// 	$newarr = array();
// 	$pid = $treeData[93]['parentid'];
// 	$pidd = $treeData[$pid]['parentid'];
// 	foreach ($treeData as $key => $value) {
// 		if($value['parentid'] == $pidd)  $newarr[$key] = $value;
// 	}
// 	return $newarr;
// }

function get_child($arr, $myid){
	$newarr = array();
	foreach ($arr as $key => $value) {
		if($value['parentid'] == $myid) $newarr[$key] = $value;
	}
	return $newarr ? $newarr : false;
}

$myid = 2;
Palry(get_child($treeData,$myid));
