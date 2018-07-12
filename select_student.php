<?php
	include("connection.php");

	if(isset($_GET['c_id']) && !empty($_GET['c_id'])):
		$c_id = $_GET['c_id'];
	else:
		header("Location:".$_SERVER['HTTP_REFERER']);
	endif;

	//echo $_SESSION['number'];
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
        
        #cover {display: none;position:fixed; top:0px; width:100%; height:100%; background-color:white}
	</style>
</head>
<body>
<?php /*981982
918985*/
?>
<div id="cover">
<div id="enterID">
<div id="idcount" class="stu_id">
	<ul>
		<li><span></span></li>
		<li><span></span></li>
		<li><span></span></li>
		<li><span></span></li>
		<li><span></span></li>
		<li><span></span></li>
		<li><span></span></li>
	</ul>
</div>
<div id="studentID" class="stu_id">
	<ul>
		<li data-digit="1"><span>1</span></li>
		<li data-digit="2"><span>2</span></li>
		<li data-digit="3"><span>3</span></li>
		<li data-digit="4"><span>4</span></li>
		<li data-digit="5"><span>5</span></li>
		<li data-digit="6"><span>6</span></li>
		<li data-digit="7"><span>7</span></li>
		<li data-digit="8"><span>8</span></li>
		<li data-digit="9"><span>9</span></li>
		<li data-digit="0"><span>0</span></li>
	</ul>
	 <button type="button" id="check">sign-in</button>
	  <button type="button" id="delete-check">delete</button>
	  <button type="button" id="cancel-check">cancel</button>
</div>
</div>



<div id="canvasDiv">
	 <button type="button" id="clear">Clear</button>
	 <button type="button" id="save">Save</button>
</div>
    
    </div>

<section class="table">
<ul class="row">
	<?php
    $getCourses = "SELECT * FROM `course` WHERE `course_id` = {$c_id} ORDER BY `title` ASC";
    $found = $mysqli->query($getCourses);

    while($row = $found->fetch_assoc()): ?>

	<li data-value="<?php echo $row['course_id']?>" ><h1><span><?php echo $row['course'] .'</span> <span>'. $row['title'];?></h1></span>
		<ul id="student">
			<?php
			    $getStudents = "SELECT * FROM `roster` r LEFT JOIN `student` s USING (`stu_id`) WHERE r.`course_id` = {$row['course_id']}";
			    $gatherStudents = $mysqli->query($getStudents);
			    while($subrow = $gatherStudents->fetch_assoc()):
			    	$present = "SELECT * FROM `attendance` WHERE `stu_id` = {$subrow['stu_id']} AND `course_id` =  {$row['course_id']} AND `week` = {$_SESSION['week']}";
			    	$status = $mysqli->query($present);
			    	$e = ($status->num_rows)? 'class="entered"':'';
			?>
			        <li data-stu="<?php echo $subrow['stu_id']?>" <?php echo $e ?>><?php echo $subrow['student'] ?>
			        <?php /* ?>
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

			    					echo "<span style='font-weight:bold'>Missed - {$missedClass->num_rows} </span> &nbsp;&nbsp;";
			    					//endif;


			    					while($status = $showWeeks->fetch_assoc()):
			    						$pa = ($status['attend'])? "p":"a";
			    				?>
									w<?php echo $status['week'] ?>-<?php echo $pa ?> |
			    				<?php
			    					endwhile;

			    			?>
			    			</li>
						</ul>
						 <?php */ ?>

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

 <button type="button" id="close-course">close course</button>


</section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script>
	function log(msg){
		console.log(msg);
	}

$matchStudentNumber = "";
$id = $('#idcount').find('li').length - 1;
$clicked = 0;
log("good");
log($id);

$('#close-course').click(function(e){
	$obj = $(e.target);
	$sel = <?php echo $_SESSION['number'] ?>;
	$c = <?php echo $c_id ?>;
	$s = $sel;
	$sendData = {
		'c':$c,
		's':$s,
		'i':"",
		'close':true
			};
			$('#enterID').show();

});

$('#studentID').find('li').click(function(){
	if(($matchStudentNumber.length) < 7){
		$matchStudentNumber += $(this).data('digit');

		$box = $('#idcount').find('li').eq($clicked);
		$box.find('span').html($(this).data('digit'));
		$clicked++;
		//log($matchStudentNumber);

	}
});

$('#check').click(function(){
	if($sendData.close){
		passIt($sendData);


	} else {
		if($sendData.s == $matchStudentNumber){

			window.scrollTo(0, 0);

			$('#enterID').fadeOut(250);
			if(!$sendData.close){
				$('#canvasDiv').fadeIn(250);
			}
		} else {
			log('no');

		}
	$clicked = 0;
	$('#idcount').find('li').each(function(){
		$(this).find('span').html('');
	});
	$matchStudentNumber = "";
	}
});

$('#delete-check').click(function(){
	if($clicked >= 0){

	$box = $('#idcount').find('li').eq(--$clicked);
	$box.find('span').html('');

	var newStr = $matchStudentNumber.substring(0, $matchStudentNumber.length-1);
$matchStudentNumber = newStr;
	} else {
		$clicked = 0;
	}
});

$('#cancel-check').click(function(){
	$('#enterID').fadeOut(250);
    $('#cover').fadeOut(250);


	$clicked = 0;
	$('#idcount').find('li').each(function(){
		$(this).find('span').html('');
	});

	$matchStudentNumber = "";
});



var canvasDiv = document.getElementById('canvasDiv');
var canvasWidth = 490;
var canvasHeight = 300;

var cX = ($(window).width()/2)-(canvasWidth/2)+'px';
var cY = ($(window).height()/2)-(canvasHeight/2)+'px';

canvas = document.createElement('canvas');
canvas.setAttribute('width', canvasWidth);
canvas.setAttribute('height', canvasHeight);

canvas.setAttribute('id', 'canvas');
canvasDiv.appendChild(canvas);
    var styles = {
      top : cY,
      left : cX
    };
$( canvas ).css( styles );


var curColor = "#000000";
if(canvas){
        var isDown      = false;
        var ctx = canvas.getContext("2d");
        var canvasX, canvasY;
        ctx.lineWidth = 5;
        var startX;

          canvas.addEventListener('touchstart', function(e){
        var touchobj = e.changedTouches[0] // reference first touch point (ie: first finger)
        //startx = parseInt(touchobj.clientX) // get x position of touch point relative to left edge of browser
        //statusdiv.innerHTML = 'Status: touchstart<br> ClientX: ' + startx + 'px'
        //log(touchobj);

        isDown = true;
        ctx.beginPath();
        canvasX = touchobj.clientX - canvas.offsetLeft;
        canvasY = touchobj.clientY - canvas.offsetTop;
        ctx.moveTo(canvasX, canvasY);
        e.preventDefault()
    }, false)

    canvas.addEventListener('touchmove', function(e){
        var touchobj = e.changedTouches[0] // reference first touch point for this event
        if(isDown != false) {
                                canvasX = touchobj.clientX - canvas.offsetLeft;
        						canvasY = touchobj.clientY - canvas.offsetTop;
                                ctx.lineTo(canvasX, canvasY);
                                ctx.strokeStyle = curColor;
                                ctx.stroke();
                        }
        e.preventDefault()
    }, false)

    canvas.addEventListener('touchend', function(e){
        var touchobj = e.changedTouches[0] // reference first touch point for this event
        isDown = false;
        ctx.closePath();
        e.preventDefault()
    }, false)


        $(canvas)
    	.mousedown(function(e){
                        isDown = true;
                        ctx.beginPath();
                        canvasX = e.pageX - canvas.offsetLeft;
                        canvasY = e.pageY - canvas.offsetTop;
                        ctx.moveTo(canvasX, canvasY);
        })
        .mousemove(function(e){
                        if(isDown != false) {
                                canvasX = e.pageX - canvas.offsetLeft;
                                canvasY = e.pageY - canvas.offsetTop;
                                ctx.lineTo(canvasX, canvasY);
                                ctx.strokeStyle = curColor;
                                ctx.stroke();
                        }
        })
        .mouseup(function(e){
                        isDown = false;
                        ctx.closePath();
        });

        $('#clear')
        .click(function(e){
                        isDown = false;
                        ctx.clearRect(0, 0, canvas.width, canvas.height);
        })

        $('#save').click(function(e){
			var d       = ctx.getImageData(0, 0, canvas.width, canvas.height); //image data
			var len     = d.data.length;
			for(var i =0; i< len; i++) {
			if(!d.data[i]) {
			drawn = false;
			//alert("Nothing");
			}else if(d.data[i]) {
			drawn = true;
			//alert('Something drawn on Canvas');
			break;
			}
			}

			if(drawn){

			//passIt($sendData);
			var canvasData = canvas.toDataURL("image/png");
			$sendData.i = canvasData;
			passIt($sendData);

			//log(canvasData);
			} else {
			log('nothing');
			}
        })
}


/* **** ***** */
$sendData = null;
	$('#student').find('li').click(function(e){
		if(!$(this).hasClass('entered')){
			$obj = $(e.target);
			$sel = $obj.data('stu');
			$c = <?php echo $c_id ?>;
			$s = $sel;
			$sendData = {
				'c':$c,
				's':$s,
				'i':""
			};
			$('#enterID').show();
            $('#cover').show();
		}
		//passIt($send);
		//$('#canvasDiv').show();
	});

	function passIt($s){

			$.ajax({
				method: "POST",
				url: "saveAttendance.php",
				data: $s
				}).done(function( msg ) {

				if(msg == true){
					isDown = false;
	                ctx.clearRect(0, 0, canvas.width, canvas.height);
	                $('#canvasDiv').fadeOut(500);
	                $('#student').find('li[data-stu='+$sendData.s+']').addClass('entered');
	                $sendData = null;
				} else{// if(msg == 'close'){
					//log(msg);
					window.location.href="<?php echo $_SERVER['REQUEST_URI'] ?>";
				}
				});

	}
</script>



</body>
</html>