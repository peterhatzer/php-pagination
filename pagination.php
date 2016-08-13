<?php 

include "connect.php";

$items = $db->query('SELECT * FROM products'); //Select database to query

$total = count($items->fetchall()); //Count the total number of items

$limit = 3; //Set a limit of how many items you want show on the page

$pages = ceil($total / $limit); //Number of pages to show. Also round number up incase last number has odd number of items

if(isset($_GET['page'])){ //Check that page isset. You can change this to what you wish
	$current_page = filter_input(INPUT_GET,"page", FILTER_SANITIZE_NUMBER_INT); //Current page number
}

if(empty($current_page)){
	header("Location:?page=1"); //If page number is set to empty will return to page 1.
}

if($current_page > $pages){
	header("Location:?page=$pages"); //If page number is greater then number of pages, redirects to last page.
}

$offset = ($current_page - 1) * $limit; //Calulation for item offset. eg (3 - 1) * 5 = 10

$stmt = $db->prepare('SELECT * FROM products LIMIT ? OFFSET ?'); //Preparing query statement

$stmt->bindParam(1, $limit, PDO::PARAM_INT); //Bind Params for limit of items
$stmt->bindParam(2, $offset, PDO::PARAM_INT); //Bind Params for offset of items

$stmt->execute(); //Executing query

$results = $stmt->fetchall(PDO::FETCH_OBJ); //Fetching the query results to show on page

?>