<?php
	include("connection.php");
	if(!isset($_SESSION['number'])):
		$_SESSION['number'] = 1138;
	endif;
	
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<title>THIS IS THE FULL UPDATE The Digital Sign-In Sheet HERE</title>
    
          <meta name="viewport" content="width=device-width, initial-scale=1">
	<style>

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
<h1>Select Week</h1>
<section class="table">
    <header><h2>Week Number</h2></header>
<ul class="row">
	<?php
    $count = 1;
    
    while($count < 12): ?>
	
	<li data-value="<?php echo $count?>" ><a href="select_course.php?w_id=<?php echo $count ?>"><span><?php echo $count ?></span></a></li>
    <?php
    $count++;
    endwhile;
	?>
</ul>
    
</section>

	
</body>
</html>
