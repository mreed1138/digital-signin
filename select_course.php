<?php
	include("connection.php");

	$current = "WI18";

    if(!isset($_SESSION['week'])):
		$_SESSION['week'] = 1;
	endif;

    if(isset($_GET['w_id'])):
       $_SESSION['week'] = $_GET['w_id'];    
    endif;

	if(!isset($_SESSION['number'])):
		$_SESSION['number'] = 1138;
	endif;
	
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Select Course Title</title>
	
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
	/*border-collapse: collapse;
	border-spacing: 0;*/
}
		
		.row {display:table; width:100%;}
		.row > li {display:table-row;  padding:0 10px; padding-bottom: 40px; width: 100%;}
		.row > li a {display:block; border:2px #000 solid; padding: 10px; width: 100%; height:100%;}
	</style>
</head>
<body>
<h1>Select Course</h1>
<section class="table">
    <header><h2>Courses</h2></header>
<ul class="row">
	<?php
    $getCourses = "SELECT * FROM `course` WHERE `qtr` = '{$current}' ORDER BY `title` ASC";
    $found = $mysqli->query($getCourses);
    
    while($row = $found->fetch_assoc()): ?>
	
	<li data-value="<?php echo $row['course_id']?>" ><a href="select_student.php?c_id=<?php echo $row['course_id'] ?>"> <span><?php echo $row['course'] .'</span> <span>'. $row['title'];?></span></a></li>
    <?php
    endwhile;
	?>
</ul>
</section>
	
</body>
</html>