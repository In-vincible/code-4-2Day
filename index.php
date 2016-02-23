<?php
$mysql_hostname = "mysql15.000webhost.com";
    $mysql_user = "a6204434_bikram";
    $mysql_password ="bikram";
    $mysql_database ="a6204434_laundry";
    
    $connection = mysqli_connect($mysql_hostname, $mysql_user, $mysql_password,$mysql_database) or die("Could not connect database");
    if(isset($_GET['key'])){
	$key = $_GET['key'];
	$query = "SELECT * FROM auth WHERE pass='".$key."'";
	$result = mysqli_query($connection,$query);
	$rows = mysqli_num_rows($result); 
	if($rows<1) header("location:registration.php?badkey=true");
	}
	else header("location:registration.php");
?>
<!DOCTYPE html>
<head>
<title>football</title>
</head>
<body>
<div id="container"></div>
<script src="jquery-1.9.1.js"></script>


<script src="fuzzyset.js"></script>
<script>

function check(token,table,fixtures,topn){
	
	var jService = "http://api.football-data.org/v1/soccerseasons/?season=2015";
	if(token==' 2015/16'){
		custHandler(topn);
	}
	else{
	theAjax(jService)
	.done(function(response){
		
		$.each(response,function(index,value){ 
		   if(matcher(value.caption,token)){
		   var url="";
		   if(!topn){
		   if(table) url = value._links.leagueTable.href;
		   else if(fixtures) url = value._links.fixtures.href;
           else url = value._links.teams.href;
		   urlHandler(url);		   
		   }
		   else custHandler(topn,value.caption,value._links.leagueTable.href);
		   }
		});
		
	});
	}	
}
function matcher(text1,text2){
	var match = FuzzySet();
    match.add(text1);
	var result = match.get(text2);
	if(result[0][0]>0.8) return true;
	return false;
}
function theAjax(uri){
 return $.ajax({
    headers:{'X-Auth-Token':'4e96c4e6e37141f6a86725fe69d05ecc'},
		type:"GET",
		dataType:"json",
		url: uri
 });
}
function urlHandler(jsLink){
	 theAjax(jsLink)
	 .done(function(response){
		jSonHandler(response);
	 });
}
function jSonHandler(data){
	var Data = JSON.stringify(data);
	//document.write(Data);
	$.when($('#dataHolder').html(Data)).done(function(){
			 $('#dataMedium').trigger("submit");
	});
}
function teamExtractor(topn,link){
	
} 	
function custHandler(topn,season,link){
	var jSonData = [];
	
	if(season==undefined){
		
		
		var jService = "http://api.football-data.org/v1/soccerseasons/?season=2015";
		theAjax(jService)
		.done(function(response){
			$.each(response,function(index,value){
				var Season = {};
				Season.season = value.caption;
				Season.teams = [];
				theAjax(value._links.leagueTable.href)
				.done(function(Response){
					
			$.each(Response.standing,function(Index,Value){
						Season.teams.push(Value);
						if(Index==topn-1) return false;
		    });
			jSonData.push(Season);
			if(index==response.length-1) jSonHandler(jSonData);
				});
			});
		
		});
	}
	else{
		        var Season = {};
				Season.season = season;
				Season.teams = [];
				
				
				theAjax(link)
				.done(function(Response){
					$.each(Response.standing,function(Index,Value){
						
						Season.teams.push(Value);
						if(Index==topn-1) return false;
					})
				
				jSonData.push(Season);	
				jSonHandler(jSonData);
				});
	}
	
}

</script>

<?php 

	if(isset($_GET['season'])) $season = $_GET['season'];
	else $season = '';
	echo'
	
	<form id="dataMedium" action="process.php" method="post" style="display:none;">
	<textarea id="dataHolder" name="data"></textarea>
	
	<input type="submit" id="button1">
	</form>
	<script>
	var table = false;
	var fixtures = false;
	var topn = false;
	var season = "' .$season. ' 2015/16";';
    if(isset($_GET['table'])) echo'
	  table = true;';	
   else if(isset($_GET['fixtures'])) echo 'fixtures=true;';
   	else if(isset($_GET['topn'])) echo 'topn='.$_GET['topn'].';'; 
	echo"	check(season,table,fixtures,topn);
	</script>
	";


//ob_end_clean();
//echo"only bikram is truth.";
//require_once "process.php";
?>
</body>
</html>