# code-4-2Day


##Introduction
This Api gives latest football data in json format.
The Api is free to use.
Anyone can use the api after getting api-key, which they will get after simple registration process.
The link of Api is: http://bikrambharti.vacau.com/
Users will be asked for registration if they don't supply key or supply wrong key.
The Api is written mostly in javascript(including jQuery) and php.
Almost everything in Api is more or less done using ajax calls so make sure the users have their javascript enabled.
The Api depends on Football-data api for football data.
The Api uses Fuzzy set Api code for search ratings.
All in all the api uses jquery which is also in open source world.


## Aim of Api
This Api is designed for football enthusiasts who can code a little.


## Features of Api
The Api is really really easy to use.
Everything is brought in one simple call, i.e. all requests are searched so that users can get data directly.


##Requirements 
Here comes the best part cause the requirement is actually zero.... :)


## How to Use Api
First of all you need to get the key and supply key:<br>
example url: http://bikrambharti.vacau.com/?key={your-key}<br>
(please note that {} is just added for clarity don't use them while supplying your key)<br>
The Api Gives the following types of Data:-<br>

1. Brief data on all seasons.<br>
   example urL: http://bikrambharti.vacau.com/?key={your-key}<br>
   (here the season argument is not set hence user get details of all seasons)<br>

2. Fixtures of particular season.<br>
  example url: http://bikrambharti.vacau.com/?key={your-key}&season={season-name}&fixtures=true<br>
  (here you can set fixtures to any value, value is set to true as per the convention but it is not compulsion but
  fixture variable should not be missing from the query)<br>
3. Detailed League Table of any particular season.<br>
  example url: http://bikrambharti.vacau.com/?key={your-key}&season={season-name}&table=true<br>
  (here you can set table to any value, value is set to true as per the convention but it is not compulsion but
  table variable should not be missing from the query)<br>
4. Details of all teams of any particular season.<br>
   example url: http://bikrambharti.vacau.com/?key={your-key}&season={season-name}<br>
   (here you just have to set the season variable)<br>
5. Details of a single Team of any particular season.<br>
   example ur: http://bikrambharti.vacau.com/?key={your-key}&season={season-name}&team={team-name}<br>
   (here extra team argument is taken)<br>
6. Detailed info of fixtures of a particular Team.<br>
   example url: http://bikrambharti.vacau.com/?key={your-key}&season={season-name}&team={team-name}&fixtures=true<br>
   (Simply fixtures argument is set to get fixtures of the team)<br>
7. Detailed info of players of a particular Team.<br>
   example url: http://bikrambharti.vacau.com/?key={your-key}&season={season-name}&team={team-name}&players=true<br>
   (Simply players argument is set to get players info of that team)<br>
8. Custom list of top n(n is selected by the user) teams of any or all seaons.<br>
   if user wishes to get the top n teams of all season, he just have to omit the variable season in query.<br>
   example url: http://bikrambharti.vacau.com/?key={your-key}&topn={any-value}<br>
   if user wishes to get the top n teams of a particular season, he can set the season variable to the that season.<br>
   example url: http://bikrambharti.vacau.com/?key={your-key}&season={season-name}&topn={any-value}<br>
<br><br>
Now the most exciting feature of api, you must have been wondering from where will you get the season name,
for that no need to bother yourself cause our api will worry about all that stuff, you just need to supply the
season name what you know and api will take care of any typos or any other small mistakes which you might have
done in writing the season name.<br>
**Api automatically matches the team/season-names supplied by the user to the names we have and the most matched team/season is selected for data extraction.**

