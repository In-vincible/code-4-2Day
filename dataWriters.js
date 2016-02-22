function leagueT(jsLink){
	theAjax(jsLink)
	.done(function(response){
        var data = JSON.stringify(response);
	$.when($("#dataHolder").html(data)).done(function(){
		$("#dataMedium").trigger("submit");});
		//$("form").submit(function(event){
		//alert("shit!!");
		
		/*document.write("<table border='1px solid'><th>League Table</th><tr><td>Position</td><td>Team Crest</td><td>Team Name</td><td>Wins</td><td>Losses</td><td>Draws</td><td>GD</td><td>played</td><td>Points</td></tr>");
		$.each(response.standing,function(index,value){
		document.write("<tr><td>"+value.position+"</td><td><img src='"+value.crestURI+"' width='70px' height='70px'></td><td>"+value.teamName+"</td><td>"+value.wins+"</td><td>"+value.losses+"</td><td>"+value.draws+"</td><td>"+value.goalDifference+"</td><td>"+value.playedGames+"</td><td>"+value.points+"</td></tr>"
			);
}); */
	});
	
}
function teamList(jsLink){
	theAjax(jsLink)
	.done(function(response){
	    var data = JSON.stringify(response);
	$.when($("#dataHolder").html(data)).done(function(){
		
		$("#dataMedium").trigger("submit");
		});
		/*document.write("<table border='1px solid'><th>Number of Teams: "+ response.count+"<br></th>");
		$.each(response.teams,function(index,value){
			document.write("<tr border='1px solid'><td><img src='"+ value.crestUrl  +"' width='100px' height='100px'></td><td>Team Name: "+ value.name+"</td><td>  Market Value: "+value.squadMarketValue+"</td></tr>");
		});
		document.write("</table>");*/
	});
}
function fixture(jsLink){
	theAjax(jsLink)
	.done(function(response){
	    var data = JSON.stringify(response);
		$.when($("#dataHolder").html(data)).done(function(){
		$("#dataMedium").trigger("submit");});
		/*document.write("<table border='1px solid'><th>Fixtures table(Total Number of Fixtures:"+response.count+")</th><tr><td>Match Day</td><td>Home Team</td><td>Away Team</td><td>result(home:away)</td><td>Timings</td></tr>");
		$.each(response.fixtures,function(index,value){
			document.write("<tr><td>"+value.matchday+"</td><td>"+value.homeTeamName+"</td><td>"+value.awayTeamName+"</td><td>"+value.result.goalsHomeTeam+" : "+value.result.goalsAwayTeam+"</td><td>"+value.date+"</td></tr>"
			                
			);
		});*/
	});
}

function check(token,table,fixtures){
	var jService = "http://api.football-data.org/v1/soccerseasons/?season=2015";
	theAjax(jService)
	.done(function(response){
		
		$.each(response,function(index,value){
			//console.log(value.caption);
			//e = JSON.stringify(response);
			//document.write(e);
            
		   var match = FuzzySet();
		   match.add(value.caption);
		   var result = match.get(token);
		   if(result[0][0]>0.8){ 
		  // document.write(result[0][1] + " " + result[0][0]+ "<br>");
		   /*
		   if(table) leagueT(value._links.leagueTable.href);
		   else if(fixtures) fixture(value._links.fixtures.href);
		   else teamList(value._links.teams.href);
           */
		   var url="";
		   if(table) url = value._links.leagueTable.href;
		   else if(fixtures) url = value._links.fixtures.href;
           else url = value._links.teams.href;
           urlHandler(url);		   
		       
		      /* if(table) url= value._links.leagueTable.href;
			   else if(fixtures) url= value._links.fixtures.href;
			   else url= value._links.teams.href; 
		   	window.location.href = "process.php?url="+url;
			*/
		   		   
		   }
		   
		});
		
	});
		
}