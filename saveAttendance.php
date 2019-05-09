<?php
	include('connection.php');
	$c = $_POST['c'];
	$s = $_POST['s'];
	$i = $_POST['i'];
	$w = $_SESSION['week'];
	if(isset($_POST['close']) && $_POST['close']):
	$getStudents = "SELECT * FROM `roster` r LEFT JOIN `student` s USING (`stu_id`) WHERE r.`course_id` = {$c}";
	$gatherStudents = $mysqli->query($getStudents);
	while($subrow = $gatherStudents->fetch_assoc()):
		$closeAttendance = "SELECT * FROM `attendance` WHERE `stu_id` = {$subrow['stu_id']} AND `course_id` = {$c} AND `week` = {$w}";
		$found = $mysqli->query($closeAttendance);

		if($found->num_rows == 0){
			$insert = "INSERT INTO `attendance` (`stu_id`, `course_id`, `week`, `attend`,`sig`) VALUES ({$subrow['stu_id']},{$c},{$w},0,'null')";
			$save = $mysqli->query($insert);
		}

		$closeAttendance = "SELECT * FROM `attendance` WHERE `stu_id` = {$subrow['stu_id']} AND `course_id` = {$c} AND `week` = {$w}";
		$found = $mysqli->query($closeAttendance);
		var_dump($found->num_rows);		
	endwhile;

	else:

	$data = substr($i, strpos($i, ",") + 1);
	$decodedData = base64_decode($data);
	$file = "signatures/{$s}-{$c}-{$w}.png";
	$fp = fopen($file, 'wb');
	fwrite($fp, $decodedData);
	fclose();

	$insert = "INSERT INTO `attendance` (`stu_id`, `course_id`, `week`, `attend`,`sig`) VALUES ({$s},{$c},{$w},1,'{$file}')";
	$save = $mysqli->query($insert);

	if($mysqli->affected_rows){
		echo true;
	}

	endif;
?>