<?php 
function db_connect($host, $db, $user, $pass)
{
	global $DB_DIE_ON_FAIL, $DB_DEBUG;
	if (!$dbh = mysql_connect($host,$user,$pass)) {
		if ($DB_DEBUG)	
		{
			echo "<h2>Can't connect to $dbhost as $dbuser</h2>";
			echo "<p><b>MySQL Error</b>: ", mysql_error();
		} else {
			echo "<h2>Database error encountered</h2>";
		}
		if ($DB_DIE_ON_FAIL) {
			echo "<p>This script cannot continue, terminating.";
			die();
		}
	}
	mysql_select_db($db,$dbh) or die("unable to select db");
	return $dbh;
}

function db_query($query, $debug=false, $die_on_debug=false, $silent=false)
{
	
	$DB_DEBUG =true;
/* run the query $query against the current database.  if $debug is true, then
 * we will just display the query on screen.  if $die_on_debug is true, and
 * $debug is true, then we will stop the script after printing he debug message,
 * otherwise we will run the query.  if $silent is true then we will surpress
 * all error messages, otherwise we will print out that a database error has
 * occurred */
	global $DB_DIE_ON_FAIL, $DB_DEBUG;
	if ($debug) {
		echo "<pre>" . htmlspecialchars($query) . "</pre>";
		$display ='Opps! Error on query';
		echo json_encode($display);
		if ($die_on_debug) die;
	}

	$qid = mysql_query($query);
	if (! $qid && ! $silent) {
		if ($DB_DEBUG) {
			echo "<h2>Can't execute query</h2>";
			echo "<pre>" . htmlspecialchars($query) . "</pre>";
			echo "<p><b>MySQL Error</b>: ", mysql_error();
		} else {
			//echo "<h2>Database error encountered</h2>";
			$display ='Opps! Error on query <br><br><br>'.mysql_error().'<br><br>';//.mysql_error();
			$rs = array('respone'=>0,'msg'=>$display);
			echo json_encode($rs);
			die;
		}
		if ($DB_DIE_ON_FAIL) {
			echo "<p>This script cannot continue, terminating.";
			die();
		}
	}
	return $qid;
}


function insert_table($tablename, $array_value=false){
		foreach($array_value as $col => $val) {
		  if ($count++ != 0) $fields .= ', ';
		  $col = mysql_real_escape_string($col);
		  $val = mysql_real_escape_string($val);
		  $fields .= "`$col` = '$val'";
		 }
		 $query = "INSERT INTO `$tablename` SET $fields;";
		 //die($query);
  	return db_query($query) ;
}

function update_table($tablename, $array_value=false,$where=false){

		foreach($array_value as $col => $val) {
		  if ($count++ != 0) $fields .= ', ';
		  $col = mysql_real_escape_string($col);
		  $val = mysql_real_escape_string($val);
		  $fields .= "`$col` = '$val'";
		 }
		 $condition = array();
			foreach ($where as $key =>$val){

			 $col = mysql_real_escape_string($key);
			  $val = mysql_real_escape_string($val);
			$condition[]= "`$col` = '$val'";;
		}
		 $where= ' WHERE '. implode(' AND ', $condition);
		// $query = "INSERT INTO `$tablename` SET $fields;";
		 $query = "UPDATE `$tablename` SET $fields $where";

		//echo $query;
		//die;
  	return db_query($query) ;
}



function getAllDataFromTable($tablename,$where=false,$limit=false,$select='*'){

	$query = "SELECT $select FROM `$tablename`";
	if (!empty($where))
            {
		$query.=' WHERE ';

		$condition = array();
		foreach ($where as $key =>$val)
                    {

			 $col = mysql_real_escape_string($key);
			  $val = mysql_real_escape_string($val);
			$condition[]= "`$col` = '$val'";;
		}

		$query.= implode(' AND ', $condition);
	}
	if ($limit != 0)
            {
		$query.=" LIMIT ".$limit;
	}

	//echo $query;
	$rs = db_query($query);

	$result=array();
	 while($rows = mysql_fetch_array($rs)) {
	  $result[] = $rows;
	}

	return $result;
}
function query_fatchdata($query){
	//echo $query;
$rs = db_query($query);
$result=array();
	 while($rows = mysql_fetch_assoc($rs)) {
	  $result[] = $rows;
	}

	return $result;
}


function getAllRecordFromTableWithJoin($tablename,$join=array(),$where=array(), $select='*',$sort=array(),$limit){
		$query = "SELECT $select FROM `$tablename`";

		$condition = array();
		$joincondition = array();

		if (!empty($join)){
		foreach ($join as $key =>$val){

			 $col = mysql_real_escape_string($key);
			  $val = mysql_real_escape_string($val);
				$query.= " JOIN $col ON $val ";;
		}
		}
		//$query.= implode(' ON ', $joincondition);

		if (!empty($where)){
		$query.=' WHERE ';
		foreach ($where as $key =>$val){

			 $col = mysql_real_escape_string($key);
			  $val = mysql_real_escape_string($val);
				$condition[]= "$col = '$val'";;
		}

		$query.= implode(' AND ', $condition);

		}

		if (!empty($sort)){
		$query.='  ';
		foreach ($sort as $ky =>$vl){

			 $cl = mysql_real_escape_string($ky);
			  $vl = mysql_real_escape_string($vl);
				$query.= " ORDER BY $cl $vl";
		}
		}
		if ($limit != 0){
		$query.=" LIMIT ".$limit;
		}
		//echo $query.'<br>';
		//die;
		$rs = db_query($query);
			$result=array();
			 while($rows = mysql_fetch_assoc($rs)) {
			  $result[] = $rows;
			}



	return $result;
	}
db_connect($host, $db, $user, $pass);

?>