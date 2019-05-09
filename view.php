<?php
	include("connection.php");
//here this was added and boy was it added
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Student Enter Attendance</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<style>
		/* http://meyerweb.com/eric/tools/css/reset/
   v2.0 | 20110126
   License: none (public domain)
*/

html, body, div, span, applet, object, iframe,
h1, h2, h3, h4, h5, h6, p, blockquote, pre,
a, abbr, acronym, address, big, cite, code,
del, dfn, em, img, ins, kbd, q, s, samp,
small, strike, strong, sub, sup, tt, var,
b, u, i, center,
dl, dt, dd, ol, ul, li,
fieldset, form, label, legend,
table, caption, tbody, tfoot, thead, tr, th, td,
article, aside, canvas, details, embed,
figure, figcaption, footer, header, hgroup,
menu, nav, output, ruby, section, summary,
time, mark, audio, video {
	margin: 0;
	padding: 0;
	border: 0;
	font-size: 100%;
	font: inherit;
	vertical-align: baseline;
}
/* HTML5 display-role reset for older browsers */
article, aside, details, figcaption, figure,
footer, header, hgroup, menu, nav, section {
	display: block;
}
body {
	line-height: 1;
}
ol, ul {
	list-style: none;
}
blockquote, q {
	quotes: none;
}
blockquote:before, blockquote:after,
q:before, q:after {
	content: '';
	content: none;
}
table {
	border-collapse: collapse;
	border-spacing: 0;
}



.stu_id {
	width:100%;

}

.stu_id li {
	float:left;
	width:80px;
	height:80px;
	margin:10px;
	text-align: center;
	border-radius: 40px;
	border:1px #000 solid;
}

#idcount li {
	width:40px;
	height:40px;
	margin: 2px;
	border-radius: 20px;
}

button {
	width:30%;
	height:50px;


}
#student li {height:50px;}
#studentID li:nth-child(3n+1) {
	clear:left;
}

#studentID li:last-child {
	float:none;
	/*margin:auto;*/
}


.stu_id li span {
	padding-top:15px;
	display:block;
}

#idcount li span {
	padding-top:5px;
	display:block;
}

li[data-value] {
	border-top:5px #a2d410 solid;
}



.entered:before {
	content: " ";
	background:url(images/checkmark.png) green center no-repeat;
	background-size: contain;
	width:25px;
	height:25px;
	display: inline-block;
}

		#canvasDiv {display: none; position: absolute; top:0; left:0; background-color: #fff; width:100%; height: 100%;}
		#enterID {display: none; position: absolute; top:0; left:0; background-color: #fff; width:100%; height: 100%;}
		#canvasDiv #canvas {box-shadow: 0 0 5px #000; position: absolute;}
		ul, li {list-style-type: none; margin: 0; padding: 0}
		#student li {height: 50px; padding:10px;}
		#student li:nth-child(odd) {background-color: #ccc}
	</style>
</head>
<body>
<?php /*981982
918985*/
?>


<section class="table">
<ul class="row">
	<?php
    $getCourses = "SELECT * FROM `course` WHERE `qtr` = 'SU17' ORDER BY `title` ASC";
    $found = $mysqli->query($getCourses);

    while($row = $found->fetch_assoc()): ?>

	<li data-value="<?php echo $row['course_id']?>" ><h1><span><?php echo $row['course'] .'</span> <span>'. $row['title'];?></h1></span>
		<ul id="student">
			<?php
			    $getStudents = "SELECT * FROM `roster` r LEFT JOIN `student` s USING (`stu_id`) WHERE r.`course_id` = {$row['course_id']}";
			    $gatherStudents = $mysqli->query($getStudents);
			    while($subrow = $gatherStudents->fetch_assoc()):
			    	$present = "SELECT * FROM `attendance` WHERE `stu_id` = {$subrow['stu_id']} AND `course_id` =  {$row['course_id']}";
			    	$status = $mysqli->query($present);
			    	$e = ($status->num_rows)? 'class="entered"':'';
			?>
			        <li data-stu="<?php echo $subrow['stu_id']?>"><?php echo $subrow['student'] ?> - <?php echo $subrow['stu_id']?>
						<ul>
							<li>
							<?php
									$view = "SELECT * FROM `attendance` a WHERE a.`course_id` = {$row['course_id']} AND a.`stu_id` = {$subrow['stu_id']} ORDER BY `week` ASC";
			    					//echo "{$view} <br><br>";
			    					$showWeeks = $mysqli->query($view);

			    					$missed = "SELECT * FROM `attendance` a WHERE a.`course_id` = {$row['course_id']} AND a.`stu_id` = {$subrow['stu_id']} AND `attend` = 0 ORDER BY `week` ASC";
			    					//echo "{$missed} <br><br>";
			    					$missedClass = $mysqli->query($missed);
									//$miss = $missedClass->fetch_row();
			    					//if($missedClass->num_rows >= 2):

			    					echo "<span style='font-weight:bold; color:red'>Missed - {$missedClass->num_rows} </span> &nbsp;&nbsp;";
			    					//endif;


			    					while($status = $showWeeks->fetch_assoc()):
			    						$pa = ($status['attend'])? "p":"a";
			    				?>
									[<?php echo $status['week'] ?><?php echo $pa ?>]&nbsp;
			    				<?php
			    					endwhile;

			    			?>
			    			</li>
						</ul>
			        </li>
			<?php
				endwhile;
			?>
		</ul>
	</li>
    <?php
    endwhile;
	?>
</ul>


</section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script>
	function log(msg){
		console.log(msg);
	}

</script>



</body>
</html>
