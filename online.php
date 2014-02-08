<?php

session_start();
mysql_connect("localhost", "root", "tuttu");
mysql_select_db("tic_tac_toe");

$game_id = $_SESSION["game_id"];
$player_id = $_SESSION["player_id"];

$get_games_query = "select * from games where id = '$game_id'";
$get_games_res = mysql_query($get_games_query) or die(mysql_error());
$games_row = mysql_fetch_array($get_games_res);

$player1 = $games_row["player1"];
$player2 = $games_row["player2"];

if ($player1 == $player_id) {
    $get_players_query = "select * from players where id = '$player2'";
} else {
    $get_players_query = "select * from players where id = '$player1'";
}

$get_players_res = mysql_query($get_players_query) or die(mysql_error());
$get_players_row = mysql_fetch_array($get_players_res);
$other_player_status = $get_players_row["status"];
echo $other_player_status;