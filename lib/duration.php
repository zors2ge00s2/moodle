<?php

require_once('../config.php');
$sql = 'SELECT id, JSON_EXTRACT(other, \'$.videoid\') as title, objectid, userid, courseid, JSON_EXTRACT(other, \'$.thisstart\') as start, JSON_EXTRACT(other, \'$.thisend\') as end, timecreated FROM {logstore_standard_log} WHERE target= \'course_video\' ORDER BY `id` ASC;';
//$sql = 'SELECT id  FROM {logstore_standard_log} WHERE target= \'course_video\';';
$discussions = $DB->get_records_sql($sql, null, $limitfrom=0, $limitnum=0);
//echo print_r($discussions[3912]);
//echo "<br>";
//echo $discussions[3912]->id;
//echo "<br>";

//need to check this in future installs, maybe have a better way of doing this
$ADMIN_ID = 2;
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=data.csv');

// create a file pointer connected to the output stream
$output = fopen('php://output', 'w');

// output the column headings
fputcsv($output, array('User id', 'Duration watched', 'Video title', 'Page id'));
$hash = array();
$lengths = array();
// $lengths["All That We Share"] = 180;
// $lengths["Airport Video"] = 
foreach($discussions as $record){
    if($lengths[$record->objectid . "*" . $record->title] == NULL){
        $sql = "SELECT end FROM (SELECT JSON_EXTRACT(other, '$.videoid') as title, objectid, JSON_EXTRACT(other, '$.thisend') as end FROM {logstore_standard_log} as log WHERE target= 'course_video' AND userid = $ADMIN_ID) as t WHERE title = $record->title AND objectid = $record->objectid ORDER BY `t`.`end` DESC LIMIT 1;";
        $len = $DB->get_record_sql($sql, null);
        //echo "length " . print_r($len);
        $lengths[$record->objectid . "*" . $record->title] = $len->end;
    }
    //echo $record->userid . '*'. $record->objectid . '*' . $record->title;
    $access =$record->userid . '*'. $record->objectid . '*' . $record->title;
    //echo "<br>" . $access . " ";
    //echo count($hash[$access]);
    if(count($hash[$access]) == 0){
         $video_length = $lengths[$record->objectid . "*" . $record->title];
         $hash[$access] = array_fill(0, $video_length, 0);
    }
    $hash[$access] = watch_segment($record->start, $record->end, $hash[$access]);
}
foreach($hash as $key => $record){
    $k = separate_key($key, $record);
    //echo $k['user'] . ",". round(calc_percentage($record),4) . "," . $k['video_title']  . "," . $k['video_page'] . '\n';
    fputcsv($output, $k);
}

function separate_key($key, $record){
    $split = explode("*", $key);
    $k = array();
    $k[0] = $split[0];
    $k[1] = round(calc_percentage($record),4);
    $k[2] = $split[2];
    $k[3] = $split[1];
    return $k;
}
function watch_segment($startid, $endid, $array){
    //echo "watching segment " . $startid . " to " . $endid;
    for($x = $startid; $x <= $endid; $x++){
        $array[$x] = 1;	
    }
return $array;
}
function calc_percentage($array){
	$count = 0;
    foreach($array as $val){
    	$count += $val;
    }
    return $count/ count($array);
}