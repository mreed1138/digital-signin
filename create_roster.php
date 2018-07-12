<?php
	include("connection.php");
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Create Roster</title>
	<link rel="stylesheet" href="">
	<style>
		/*.table {display:table; width:100%;}
		.row {display:table-row;}
		.row > li {display:table-cell; border:1px #000 solid; padding:0 10px;}
		span ~ span {display: block;}*/
	</style>
</head>
<body>

<section class="table">
<ul class="row">
	<?php
    $getCourses = "SELECT * FROM `course` ORDER BY `title` ASC";
    $found = $mysqli->query($getCourses);
    
    while($row = $found->fetch_assoc()): ?>
	
	<li data-value="<?php echo $row['course_id']?>" ><span><?php echo $row['course'] .'</span><span>'. $row['title'];?></span>
		<ul id="student">
			<?php
			    $getStudents = "SELECT * FROM `roster` r LEFT JOIN `student` s USING (`stu_id`) WHERE r.`course_id` = {$row['course_id']}";
			    $gatherStudents = $mysqli->query($getStudents);
			    while($subrow = $gatherStudents->fetch_assoc()):
			?>
			        <li data-value="<?php echo $subrow['student_id']?>"><?php echo $subrow['student'] ?></li>
			<?php
				endwhile;
			?>
		</ul>
	</li>
    <?php
    endwhile;
	?>
</ul>

	
</body>
</html>