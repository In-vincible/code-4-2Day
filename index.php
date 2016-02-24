<?php
//Database credentiols
$mysql_hostname = "mysql15.000webhost.com";
    $mysql_user = "a6204434_bikram";
    $mysql_password ="bikram";
    $mysql_database ="a6204434_laundry";
    
    $connection = mysqli_connect($mysql_hostname, $mysql_user, $mysql_password,$mysql_database) or die("Could not connect database");
    if(isset($_GET['key'])){   //checking if key is sent
	$key = $_GET['key'];
	$query = "SELECT * FROM auth WHERE pass='".$key."'";
	$result = mysqli_query($connection,$query);
	$rows = mysqli_num_rows($result); 
	if($rows<1) header("location:registration.php?badkey=true"); //if key didn't match with any of the entries in database(bad key message)
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
//check function is the mother function which takes all the requests token is season query.
//it checks the conditions and retrieves initial data with that data being searched new data is retrieved using urlHandler and custHandler
function check(token,table,fixtures,topn,team,players){
	
	var jService = "http://api.football-data.org/v1/soccerseasons/?season=2015";
	if(token==' 2015/16'){
		if(topn){
		$.when(getCach("undefined#"+topn,'custom'))
		.done(function(data){
		if(data == "#") custHandler(topn);
		else jSonHandler(data);	
		});
		}
		else{
			$.when(getCach("seasons",'teams'))
			.done(function(data){
				if(data == '#') urlHandler(jService,"seasons","teams");
				else jSonHandler(data);
			})
		}
	}
	else{
	theAjax(jService)
	.done(function(response){
		
		$.each(response,function(index,value){ 
		   if(matcher(value.caption,token,0.8)){
		   var url="";var qtype="";
		   if(!topn){
           if(!team){		
		   if(table) {url = value._links.leagueTable.href;qtype='table';}
		   else if(fixtures){url = value._links.fixtures.href;qtype='fixtures';}
           else{url = value._links.teams.href;qtype='teams';}
		   $.when(getCach(value.caption,qtype))
		   .done(function(data){
			   if(data == "#") urlHandler(url,value.caption,qtype);		   
		       else jSonHandler(data);

		   });
		   }
		   else{
			   theAjax(value._links.teams.href)
			   .done(function(data){
				   $.each(data.teams,function(Index,Value){console.log(Value.name);
					   if(matcher(Value.name,team,0.65)){console.log("entered");
						   var Url="";var Qtype="";
						   if(fixtures){Url=Value._links.fixtures.href;Qtype='team-fixtures';}
						   else if(players){Url=Value._links.players.href;Qtype='players';}
						   else {Url=Value._links.self.href;Qtype='team';}
						   $.when(getCach(Value.name,Qtype))
						   .done(function(Data){
							   if(Data=='#') urlHandler(Url,Value.name,Qtype);
							   else jSonHandler(Data);
						   });
					   }
					  
				   });
			   });
		   }
		   }
		   else {
			$.when(getCach(value.caption+"#"+topn,'custom'))
			.done(function(data){
			
			if(data == "#") custHandler(topn,value.caption,value._links.leagueTable.href);
			else jSonHandler(data);
			});
		   }
		   }
		});
		
	});
	}	
}
//this function simply matches any two text with given precision
function matcher(text1,text2,precision){
	var match = FuzzySet();
    match.add(text1);
	var result = match.get(text2);
	if(result[0][0]>precision){ delete(match);delete(result); return true;}
	delete(match);delete(result);
	return false;
}
//this function simply returns the xhr object
function theAjax(uri){
 return $.ajax({
    headers:{'X-Auth-Token':'4e96c4e6e37141f6a86725fe69d05ecc'},
		type:"GET",
		dataType:"json",
		url: uri
 });
}
//this function takes query jslink for getting data and query and qtype simply to pass to jsonhandler
function urlHandler(jsLink,query,qtype){
	 theAjax(jsLink)
	 .done(function(response){
		jSonHandler(response,query,qtype);
	 });
}
//it simply triggers the form to send data to process.php which prints the data, it also plants cache in database if supplied with query and qtype
function jSonHandler(data,query,qtype){
	var Data = JSON.stringify(data);
	if(!(query == 'undefined')) plantCach(query,qtype,Data);
	$.when($('#dataHolder').html(Data)).done(function(){
			 $('#dataMedium').trigger("submit");
	});
}
//this is customHandler as it retrieves data from different links(topn datas for different seasons) and add and stuff them in a class and then send them
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
			if(index==response.length-1) jSonHandler(jSonData,season+"#"+topn,'custom');
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
				jSonHandler(jSonData,season+"#"+topn,'custom');
				});
	}
	
}
//this one simply checks if cache of a query exists and is not older than 7 days if exists returns the saved data else returns "#" 
function getCach(query,qtype){
return	$.post( "cachHandler.php", { query: query, qtype: qtype })
  .done(function( data ){
	return data;
  });
}
//this function plants cache in the qtype table
function plantCach(query,qtype,data){
	$.post("cachHandler.php",{query: query, qtype: qtype, data:data})
	.done(function(data){
		alert("cache Insert Id:"+data);
	});
}
</script>

<?php 

	if(isset($_GET['season'])){ $season = $_GET['season'];
	if(isset($_GET['team'])) $team = $_GET['team'];	
	else $team = false;
	}
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
	var team = false;
	var players = false;
	var season = "' .$season. ' 2015/16";';
	if($team) echo'team = "'.$team.'";';
    if(isset($_GET['table'])) echo'table = true;';
	else if(isset($_GET['players'])) echo'players = true;';
    else if(isset($_GET['fixtures'])) echo 'fixtures=true;';
   	else if(isset($_GET['topn'])) echo 'topn='.$_GET['topn'].';'; 
	 
	echo"	check(season,table,fixtures,topn,team,players);
	</script>
	";


//ob_end_clean();
//echo"only bikram is truth.";
//require_once "process.php";
?>
</body>
</html>