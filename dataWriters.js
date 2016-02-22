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