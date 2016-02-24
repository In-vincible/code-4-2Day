# code-4-2Day


##Introduction
This Api gives latest football data in json format.
The Api is free to use.
Anyone can use the api after getting api-key, which they will get after simple registration process.
The link of Api is: http://bikrambharti.vacau.com/
Users will be asked for registration if they don't supply key or supply wrong key.
The Api is written mostly in javascript(including jQuery) and php.
Almost everything in Api is more or less done using ajax calls so make sure the users have their javascript enabled.


## Aim of Api
This Api is designed for football enthusiasts who can code a little.


## Features of Api
The is really really easy to use.
Everything is brought in one simple call, i.e. all requests are searched so that users can get data directly.


##Requirements 
Here comes the best part cause the requirement is actually zero.... :)


## How to Use Api
First of all you need to get the key and supply key:
example url: http://bikrambharti.vacau.com/?key=<your-key>
(please note that <> is just added for clarity don't use them while supplying your key)
The Api Gives 5 types of Data:-
1. Fixtures of particular season.
  example url: http://bikrambharti.vacau.com/?key=<your-key>&season=<season-name>&fixtures=true
  (here you can set fixtures to any value, value is set to true as per the convention but it is not compulsion but
  fixture variable should not be missing from the query)
2. Detailed League Table of any particular season.
  example url: http://bikrambharti.vacau.com/?key=<your-key>&season=<season-name>&table=true
  (here you can set table to any value, value is set to true as per the convention but it is not compulsion but
  table variable should not be missing from the query)
3. Details of all teams of any particular season.
   example url: http://bikrambharti.vacau.com/?key=<your-key>&season=<season-name>
  (here you just have to set the season variable)
4. Custom list of top n(n is selected by the user) teams of any or all seaons.
   if user wishes to get the top n teams of all season, he just have to omit the variable season in query.
   example url: http://bikrambharti.vacau.com/?key=<your-key>&topn=<any value>
   if user wishes to get the top n teams of a particular season, he can set the season variable to the that season.
   example url: http://bikrambharti.vacau.com/?key=<your-key>&season=<season-name>&topn=<any value>

Now the most exciting feature of api, you must have been wondering from where will you get the season name,
for that no need to bother yourself cause our api will worry about all that stuff, you just need to supply the
season name what you know and api will take care of any typos or any other small mistakes which you might have
done in writing the season name.
Api automatically matches the names to the names we have and the most matched season is selected for data extraction.

