<?PHP

function html_header($title)
{
	echo '
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!--
Name       : RD DIVISION 
Description: HTML HEAD
Version    : 1.0
Released   : 
-->
<html>
<head>
<title>'.$title.'</title>
<link rel="icon" href="images/CEPTAMlogo.png">
<!--Style Sheet CSS-->
<link rel="stylesheet" type="text/css" href="css/appstyle.css"   >
<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
<meta content="text/html;charset=utf-8" http-equiv="Content-Type">
<meta content="utf-8" http-equiv="encoding">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!--JQuery , validation and bootstrap-->
<script src="js/jquery-3.2.1.min.js"></script>
<script src="js/validate.min.js"></script>
<script src="js/bootstrap.min.js"></script>

<!-- <script src="http://code.jquery.com/jquery.js"></script> -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script>


	$(document).ready(function(){
		
		$("#board_list").change(function(){
				
				//$("#loader").show();
				//alert("this is test");
				var getUserID = $(this).val();
				
				if(getUserID != "0")
				{
					//alert("this is if case"+getUserID);
					$.ajax({
						type: "GET",
						url: "load_dates.php",
						data: {customer_id:getUserID},
						success: function(data){
							//alert("HERE");
							//$("#loader").hide();
							$("#board_date").html(data);
						}
					});
				}
				else
				{
					$("#board_date").html("SELECT SOMETHING");
					//alert("this is else");
				}
		});
		
		$("#board_date").change(function(){
				
			//$("#loader").show();
			//alert("this is test");
			var getData = $(this).val();
//			alert("board_date: "+$(this).val().toString());
			console.log(getData);
			
			if(getData != "0")
			{
				//alert("this is if case");
				$.ajax({
					type: "GET",
					url: "loader.php",
					data: {board_data:getData},
					success: function(data){
						//alert("HEREDATE");
						//$("#loader").hide();
						$("#CandidateList").html(data);
						//alert(getData);
					}
				});
			}
			else
			{
				$("#CandidateList").html("SELECT VALUES");
				//alert("this is else");
			}
	});
	
		
	});
	

</script>  
</head>
<body>
<table align="center" width="100%" style="border:1px solid #000000;">
	<tr>
		<td width="15%" rowspan="2" >
				<img style="padding:10px;" src="images/CEPTAMlogo.png" height="130" width="130"/>
			</td> 
	</tr>
	<tr>
		<td width="85%"  align="center">
			<h2>CENTRE FOR PERSONNEL TALENT MANAGEMENT (CEPTAM)</h2>
			<h3><u>IT DIVISION</u></h3>
			 
		</td>
	</tr>
	
			
		

</table>';
}
 


?>
