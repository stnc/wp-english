<?php


$servername = "localhost";
$username = "root";
$password = "";
//
// Create connection

$dbname = "education";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
} 


$catID=279;


$sectionID=69;
$gun=78;


/*

["64.GÜN-70.GÜN", "64-gun-70-gun", 277, 1, null]
["71.GÜN-77.GÜN", "71-gun-77-gun", 278, 6, null]
["78.GÜN-90.GÜN", "78-gun-90-gun", 279, 2, null]
*/








$sql = "
SELECT 
cat_posts.ID as ID
FROM wp_posts AS cat_posts
INNER JOIN wp_term_relationships AS cat_term_relationships ON cat_posts.ID = cat_term_relationships.object_id
INNER JOIN wp_term_taxonomy AS cat_term_taxonomy ON cat_term_relationships.term_taxonomy_id = ".$catID."
INNER JOIN wp_terms AS cat_terms ON cat_term_taxonomy.term_id = cat_terms.term_id
INNER JOIN wp_postmeta AS meta ON cat_posts.ID = meta.post_id
WHERE cat_posts.post_status =  'publish'
AND cat_posts.post_type =  'post'
group by cat_posts.ID";
$result = $conn->query($sql);


$wp_posts = array();




if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "<br>";
    echo "id: " . $row["ID"];
	array_push($wp_posts, $row["ID"]);
  }
} else {
  echo "0 results";
}
$conn->close();



echo "<pre>";
 print_r($wp_posts );



$filename="gun".$gun."-sec".$sectionID.".txt";
// $filename="datasec".$sectionID.".txt";
$text =""; 
foreach ($wp_posts as $x => $y) {
   echo "$y <br>";
$item_id= $y;
$item_order= $x;
 $text .= "UPDATE `education`.`wp_posts` SET `post_type`='lp_lesson' WHERE  `ID`=$y; \n ";
echo "<br>";
 $text .=  "INSERT INTO `education`.`wp_learnpress_section_items` (`section_id`, `item_id`, `item_order`, `item_type`) VALUES ($sectionID, $item_id, 1, 'lp_lesson'); \n" ;
echo "<br>";
}



$fh = fopen($filename, "a");
fwrite($fh, $text  );
 fclose($fh);