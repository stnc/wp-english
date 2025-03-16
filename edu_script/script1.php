<?php

/*
SET sql_mode = '' ;
SELECT 
cat_posts.ID as ID
FROM wp_posts AS cat_posts
INNER JOIN wp_term_relationships AS cat_term_relationships ON cat_posts.ID = cat_term_relationships.object_id
INNER JOIN wp_term_taxonomy AS cat_term_taxonomy ON cat_term_relationships.term_taxonomy_id = 222
INNER JOIN wp_terms AS cat_terms ON cat_term_taxonomy.term_id = cat_terms.term_id
INNER JOIN wp_postmeta AS meta ON cat_posts.ID = meta.post_id
WHERE cat_posts.post_status =  'publish'
AND cat_posts.post_type =  'post'
group by cat_posts.ID
*/
// UPDATE `education`.`wp_posts` SET `post_type`='lp_lesson' WHERE  `ID`=2780; //post type degistirir
// INSERT INTO `education`.`wp_learnpress_section_items` (`section_id`, `item_id`, `item_order`, `item_type`) VALUES (11, 3288, 1, 'lp_lesson');


// echo "<pre>";
// print_r($wp_posts );
// echo "<pre>";
// print_r($wp_posts[0][0] );
// echo "<br>";

$wp_posts = [
	[
		2817,
	],
	[
		2816,
	],
	[
		2815,
	],
	[
		2803,
	],
];



$sectionID=22;
$gun=18;





$filename="gun".$gun."-sec".$sectionID.".txt";
$text =""; 
foreach ($wp_posts as $x => $y) {
//   echo "$y[0] <br>";
$item_id= $y[0];
$item_order= $x;
$text .= "UPDATE `education`.`wp_posts` SET `post_type`='lp_lesson' WHERE  `ID`=$y[0]; \n ";
echo "<br>";
$text .=  "INSERT INTO `education`.`wp_learnpress_section_items` (`section_id`, `item_id`, `item_order`, `item_type`) VALUES ($sectionID, $item_id, 1, 'lp_lesson'); \n" ;
echo "<br>";
}



$fh = fopen($filename, "a");
fwrite($fh, $text  );
fclose($fh);