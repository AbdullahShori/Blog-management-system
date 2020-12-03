<?php require("db.php");
$result = mysqli_query($con, "SELECT * FROM likes where post_id= $postId  ORDER BY id ASC");

echo "<div class='likes'>";

	echo "<h1 style='font-size:20px;'> Post Id </h1>";
	echo "<h1 style='font-size:20px;'> Liked By </h1>";
	
echo "</div>";
while($row = mysqli_fetch_assoc($result)){
	
echo "<div class='likes'>";

	echo "<h1 style='font-size:20px;'>" . $row['post_id'] . "</h1>";
	echo "<h1 style='font-size:20px;'>" . $row['name'] . "</h1>";
	
echo "</div>";
}
?>
