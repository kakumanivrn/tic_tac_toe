<?php
session_start();

$_SESSION["player_id"] = $_GET["player_id"];
$player_id = $_SESSION["player_id"];

$_SESSION["game_id"] = $_GET["game_id"];
$game_id = $_SESSION["game_id"];
?>

<html>
    <title>Tic Tac Toe</title>
    <body>
    <center>
        <h3 id="status"></h3>
        <table border="1">
            <tr>
                <td><input type="button" onclick="postData(this.id)" value="X" id="0_2"></td>
                <td><input type="button" onclick="postData(this.id)" value="X" id="1_2"></td>
                <td><input type="button" onclick="postData(this.id)" value="X" id="2_2"></td>
            </tr>
            <tr>
                <td><input type="button" onclick="postData(this.id)" value="X" id="0_1"></td>
                <td><input type="button" onclick="postData(this.id)" value="X" id="1_1"></td>
                <td><input type="button" onclick="postData(this.id)" value="X" id="2_1"></td>
            </tr>
            <tr>
                <td><input type="button" onclick="postData(this.id)" value="X" id="0_0"></td>
                <td><input type="button" onclick="postData(this.id)" value="X" id="1_0"></td>
                <td><input type="button" onclick="postData(this.id)" value="X" id="2_0"></td>
            </tr>
        </table>
    </center>
</body>
</html>
<script>
    function postData(pos) {
        var xmlhttp;
        if (window.XMLHttpRequest) {
            xmlhttp = new XMLHttpRequest();
        } else {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
                if (xmlhttp.responseText != "") {
                    alert(xmlhttp.responseText);
                }
            }
        };
        xmlhttp.open("GET", "post_position.php?pos=" + pos + "&game_id=<?= $game_id ?>", true);
        xmlhttp.send();
    }

    function checkStuff() {
        var xmlhttp;
        if (window.XMLHttpRequest) {
            xmlhttp = new XMLHttpRequest();
        } else {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
                if (xmlhttp.responseText != "") {
                    if(xmlhttp.responseText == "offline") {
                        document.getElementById("status").innerHTML = "Waiting for other player to come online";
                    } else {
                        document.getElementById("status").innerHTML = "Start the game";
                    }
                }
            }
        };
        xmlhttp.open("GET", "online.php?game_id=<?= $game_id ?>", false);
        xmlhttp.send();
        setTimeout('checkStuff()', 1000);
    }
    checkStuff();
</script>