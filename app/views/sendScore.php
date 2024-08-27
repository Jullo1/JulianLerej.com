<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'] . "/include/config.php";
$conn = new mysqli("$hostname", "$username", "$password", "$database");
$score = $_POST["score"];
$game = $_POST["game"];

//initialize username in rankings
if ($_SESSION['user_name'] != "")
    $conn->query("INSERT INTO leaderboard (Username) VALUES ('{$_SESSION['user_name']}')");

//send score on current game if higher than previous score
$sql3 = $conn->query("SELECT {$game} FROM leaderboard WHERE Username='{$_SESSION['user_name']}'");
$currentScore = $sql3->fetch_assoc();

if ($score > $currentScore[$game]){
    $conn->query("UPDATE leaderboard SET {$game} = {$score} WHERE Username='{$_SESSION['user_name']}'");
    //update total
    $sql2 = $conn->query("SELECT (Trivia + Memotest + Puzzle + Rush + Fist) AS SUM FROM leaderboard WHERE Username='{$_SESSION['user_name']}'");
    
    $total = $sql2->fetch_assoc();
    $conn->query("UPDATE leaderboard SET Total = {$total['SUM']} WHERE Username='{$_SESSION['user_name']}'");
}

$conn->close();
?>
