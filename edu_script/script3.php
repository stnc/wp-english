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


$wp_term_taxonomy = [
	
	[
		'19. GUN',
		'19',
		233,
		5,
		null,
	],
	[
		'20. GUN',
		'20',
		234,
		5,
		null,
	],
	[
		'21. GUN',
		'21',
		235,
		5,
		null,
	],
	[
		'22. GUN',
		'22',
		236,
		6,
		null,
	],
	[
		'23. GUN',
		'23',
		237,
		5,
		null,
	],
	[
		'24. GUN',
		'24',
		238,
		6,
		null,
	],
	[
		'25. GUN',
		'25',
		239,
		5,
		null,
	],
	[
		'26. GUN',
		'26',
		240,
		5,
		null,
	],
	[
		'27. GUN',
		'27',
		241,
		5,
		null,
	],
	[
		'28.gun',
		'28',
		242,
		5,
		null,
	],
	[
		'29 gun',
		'29',
		243,
		8,
		null,
	],
	[
		'30.gun',
		'30',
		244,
		5,
		null,
	],
	[
		'31. gun',
		'31',
		245,
		6,
		null,
	],

	[
		'33 gun',
		'33',
		247,
		5,
		null,
	],
	[
		'34 gun',
		'34',
		248,
		5,
		null,
	],
	[
		'35 gun',
		'35',
		249,
		5,
		null,
	],
	[
		'36 gun',
		'36',
		250,
		6,
		null,
	],
	[
		'37 gun',
		'37',
		251,
		5,
		null,
	],
	[
		'38 gun',
		'38',
		252,
		5,
		null,
	],
	[
		'39 gun',
		'39',
		253,
		5,
		null,
	],
	[
		'40 gun',
		'40',
		254,
		5,
		null,
	],
	[
		'41 gun',
		'41',
		255,
		5,
		null,
	],
	[
		'42 gun',
		'42',
		256,
		5,
		null,
	],
	[
		'43 GU N',
		'43',
		258,
		6,
		null,
	],
	[
		'44 GUN',
		'44',
		257,
		5,
		null,
	],
	[
		'45 gun',
		'45',
		259,
		6,
		null,
	],
	[
		'46 gun',
		'46',
		260,
		5,
		null,
	],
	[
		'47 gu',
		'47',
		261,
		5,
		null,
	],
	[
		'48 gun',
		'48',
		262,
		5,
		null,
	],
	[
		'49 gun',
		'49',
		263,
		5,
		null,
	],
	[
		'50 gun',
		'50',
		264,
		9,
		null,
	],
	[
		'51 gun',
		'51',
		265,
		6,
		null,
	],
	[
		'52 gun',
		'52',
		228,
		6,
		null,
	],
	[
		'53 gun',
		'53',
		266,
		5,
		null,
	],
	[
		'54 gun',
		'54',
		267,
		5,
		null,
	],
	[
		'55 gun',
		'55',
		268,
		5,
		null,
	],
	[
		'56 gun',
		'56',
		269,
		4,
		null,
	],
	[
		'57 gun',
		'57',
		270,
		4,
		null,
	],
	[
		'58 gun',
		'58',
		271,
		3,
		null,
	],
	[
		'59 gun',
		'59',
		272,
		3,
		null,
	],
	[
		'60 gun',
		'60',
		273,
		3,
		null,
	],
	[
		'61 gun',
		'61',
		274,
		3,
		null,
	],
	[
		'62 gun',
		'62',
		275,
		3,
		null,
	],
	[
		'63 gun',
		'63',
		276,
		2,
		null,
	],

];


$section=23;
foreach ($wp_term_taxonomy as $x => $y) {

 $catID=$y[2];
 $sectionID=$section++;
echo "<br>";
$gun=$y[1];




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




echo "<pre>";
 print_r($wp_posts );



// $filename="gun".$gun."-sec".$sectionID.".txt";
$filename="onfile.txt";

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

}










$conn->close();
