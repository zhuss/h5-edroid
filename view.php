<?php
require_once 'PdoUtil.php';

header('Access-Control-Allow-Origin:*');


function ls($start, $count, &$total) {
	$pdo = PdoUtil::get();
	$total = 0;
	$items = array();
	
	if($rs = $pdo->query("SELECT COUNT(*) FROM app_app")) {
		if($r = $rs->fetch(PDO::FETCH_NUM))
			$total = $r[0];
	}
	
	if($total <= 0)
		return $items;
	
	if($rs = $pdo->query("SELECT _id,label,iconUrl,url,vern,size,star,dl FROM app_app LIMIT $start,$count")) {
		while($r = $rs->fetch(PDO::FETCH_OBJ)) {
			array_push($items, $r);
		}
	}
	
	return $items;
}

function banner() {
	$pdo = PdoUtil::get();
	$items = array();
	
	if($rs = $pdo->query("SELECT * FROM app_banner WHERE stat=1")) {
		while($r = $rs->fetch(PDO::FETCH_OBJ)) {
			array_push($items, $r);
		}
	}
	
	return $items;
}

function details($_id) {
	$pdo = PdoUtil::get();
	if($rs = $pdo->query("SELECT * FROM app_app WHERE _id=$_id")) {
		if($r = $rs->fetch(PDO::FETCH_OBJ)) {
			return $r;
		}
	}
	return FALSE;
}

PdoUtil::open();

switch (get_f('action')) {
	case 'ls': {
		$ret = ls(get_f('start'), get_f('count'), $total);
		die(json_encode(array('total'=>$total, 'rows'=>$ret)));
		break;
	}
	
	case 'banner': {
		die(json_encode(banner()));
		break;
	}

	case 'details': {
		$ret = details(get_f('_id'));
		if($ret == FALSE)
			die('false');
		else
			die(json_encode($ret));
		break;
	}
}


