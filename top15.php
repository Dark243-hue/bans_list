<?php
// CONFIG: Replace these with your actual MySQL details
$host = "localhost";
$user = "your_db_user";
$password = "your_db_password";
$dbname = "your_db_name";

// Create connection
$conn = new mysqli($host, $user, $password, $dbname);

// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

// Query the player stats table
$sql = "SELECT name, steamid, points, xp FROM zp_stats ORDER BY xp DESC LIMIT 100";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
	<title>XP & Points Leaderboard</title>
	<style>
		body { font-family: Arial, sans-serif; background: #f4f4f4; }
		table { border-collapse: collapse; margin: 30px auto; width: 80%; background: #fff; }
		th, td { padding: 12px 20px; border: 1px solid #ccc; text-align: center; }
		th { background: #333; color: white; }
		tr:nth-child(even) { background-color: #f2f2f2; }
		h2 { text-align: center; margin-top: 40px; }
	</style>
</head>
<body>
	<h2>Zombie Server Leaderboard (XP & Points)</h2>
	<table>
		<tr>
			<th>#</th>
			<th>Name</th>
			<th>Steam ID</th>
			<th>Points</th>
			<th>XP</th>
		</tr>
		<?php
		if ($result->num_rows > 0) {
			$rank = 1;
			while($row = $result->fetch_assoc()) {
				echo "<tr>";
				echo "<td>" . $rank++ . "</td>";
				echo "<td>" . htmlspecialchars($row["name"]) . "</td>";
				echo "<td>" . $row["steamid"] . "</td>";
				echo "<td>" . $row["points"] . "</td>";
				echo "<td>" . $row["xp"] . "</td>";
				echo "</tr>";
			}
		} else {
			echo "<tr><td colspan='5'>No data found</td></tr>";
		}
		?>
	</table>
</body>
</html>

<?php $conn->close(); ?>
