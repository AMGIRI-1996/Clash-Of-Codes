# Clash-Of-Codes
You can make your own online bot competition.
You can choose any game you want and place a competition of making bots for that game. 
Our interface will help them to compete with each other and to find loop holes to improve the game. 
In the end you can have a knockout tournament for these bots and can decide the winner.

If you want to host any coding competition use my work to host on your server or if you dont have any server you can ask me i will provise you one for such purpose.
if you are a developer you can use this code for other works . But it shold be notified to me before using it.
If you find any difficulties in implementing this project you can always drop me a mail.
I will do my best to help you.
--- My email id( anuragmgiri@gmail.com ).

Interface works as

1.user will submit bot created by them(a .cpp program for the given game)
      in this program user will be given input of the current game (if its board game user will ger info about board and player number)
      then its the task of program to output its move.
      
      Its your job to decide code numbers for different things of the game for example you can say -1 denotes blank space , 1 denotes player 1..etc...
      
2.user will login on the inetrface and will submit his/her code
3.now user can select the opponent bot from the list of players who already have submitted their code of bot.
4.our interface will give initial input to player1 (logged in player) (initial input will be decided by you as it depends on the game).
5.then our interface will read outputed result and will be submitted to monitre.cpp(made by you) to check whether it is valid move or not.
6.mopniter.cpp will return -11111 if wrong move, -22222 if player won the game, -33333 if player loose, -44444 if its draw. If it is valid move then it will return the input for player 2.
7.the outputed input for player2 will be given to player 2 bot and its outputed result will be gib=ven to moniter.cpp to check the move as in previous step

thus this will continue till a result comes. 

Your work:---
  you need to make a moniter.cpp according to your choosen game. [If you find any difficulty in this you can ask help from me :) ]
    if input is -255 it will return initial input to player 1
    else input format will be --- input given to the player concatened with output returned from player
    now its job of moniter.cpp to first check is the given ouput by player is correct or not
    if valid move:- check if player won or loose or this move made draw?
                    if any thing of these happens:-
                          output :  -22222  if player won
                                    -33333  if player loose
                                    -44444  if its draw
                     else output input to be given to other player
    if its invalid move output: -11111
    
    thats it. A sample moniter.cpp is provided in codes folder for the cage game.
    
    Its always better to give a random bot for your game.
    that will play randomly and now user just need to focus on algorithm or ligic to be implemented.
    
After making this program replace moniter.cpp with your moniter.cpp 
whenever some user will enter code his/her file will be generated automatically.

Description of interface:-

login.php
  registers new user
        sends mail to verify new user
        user then need to click on link in eamil to verify.
        (if you want to skip this step modify in this file to reflect).
  or login if already registered
        it redirects then to index.php if emailid and password is right
        
        
index.php
  takes users code and check if there is some error if so notifies user
  if no error - stores code in user file and make it available for other competitors to compete with it
  
  after that it will redirect user to trial-exec.php


trial-exec.php
  its main purpose id to select opponent from the list
  it initilises required variables which are required in next files.
  
play.php
  this is the main file where everything is done
  
  and then redirect to end.php for animation purpose
 
 
end.php

  just for animation and for storing final result on gameboard
  
table.php
  it stores and display information about matches played in the form of table
  as player1 name, player2 name and winner name
  its more like leaderboard only

activate.php
  its when user verifies himself after clicking on the link in mail.
  
connect_algodb.php
  for database connection
  
core.php
  for some functions
 
countdown.php
  for countdown
  
terminal.php
  when you will make this competition online remove this file
  this is for your your sake as sometimes due to bad programming cpu usage of your server goes beyond 80% so makes your server slow so in such situations use this file to run (kill -9 -1) instruction.

games.php
  this is to choose player1 and player2 by yourself and have a match between them
  remove this file when competition is online .
  this is for knockout matches where you will get the winner of competition.
  

 
