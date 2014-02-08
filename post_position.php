<?php

session_start();
mysql_connect("localhost", "root", "");
mysql_select_db("tic_tac_toe");

$player_id = $_SESSION["player_id"];
$game_id = $_SESSION["game_id"];

$position = $_GET["pos"];
$pos_array = explode("_", $position);

$x = $pos_array[0];
$y = $pos_array[1];

$insert_xy = "insert into game_stats (player_id, game_id, x, y) VALUES ('$player_id','$game_id', '$x', '$y')";
mysql_query($insert_xy) or die(mysql_error());

$check_score = "select * from game_stats where player_id = '$player_id' and game_id = '$game_id'";
$check_score_res = mysql_query($check_score) or die(mysql_error());

$i = 0;
while ($row = mysql_fetch_array($check_score_res)) {
    $x[$i] = $row["x"];
    $y[$i] = $row["y"];
    $i++;
}

if (mysql_num_rows($check_score_res) == 3) {
    $bool = is_straight_line($x[0], $x[1], $x[2], $y[0], $y[1], $y[2]);
    if ($bool) {
        echo 'You won!';
    } else {
        echo 'Go home!';
    }
}

if (mysql_num_rows($check_score_res) == 4) {
    $bool1 = is_straight_line($x[0], $x[1], $x[2], $y[0], $y[1], $y[2]);
    $bool2 = is_straight_line($x[0], $x[1], $x[3], $y[0], $y[1], $y[3]);
    $bool3 = is_straight_line($x[0], $x[2], $x[3], $y[0], $y[2], $y[3]);
    $bool4 = is_straight_line($x[1], $x[2], $x[3], $y[1], $y[2], $y[3]);
    if ($bool1 || $bool2 || $bool3 || $bool4) {
        echo 'You won!';
    } else {
        echo 'Go home!';
    }
}

function is_straight_line($x1, $x2, $x3, $y1, $y2, $y3) {
    $slope1 = ($y2 - $y1) / ($x2 - $x1);
    $slope2 = ($y3 - $y2) / ($x3 - $x2);
    if ($slope1 == $slope2) {
        return TRUE;
    }
    return FALSE;
}