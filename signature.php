<?php
// MySQL Connection Variables
$servername = "localhost"; // Your MySQL host
$username = "username"; // Your MySQL Username
$password = "password"; // Your MySQL Password
$database = "db"; // Your MySQL Database Name

// Get player ID from URL
$user_id = isset($_GET['user_id']) ? $_GET['user_id'] : null;

if ($user_id) {
    // Create connection to MySQL using MySQLi
    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Escape the user input to prevent SQL injection
    $user_id = $conn->real_escape_string($user_id);

    // Prepare and bind the query to prevent SQL injection
    $query = $conn->prepare("SELECT `Playername`, `Level`, `Kills`, `Points`, `Money`, `Clan`, `Vehicle` FROM `stats` WHERE `uid` = ? LIMIT 1");
    $query->bind_param("s", $user_id); // "s" indicates that the parameter is a string
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows > 0) {
        // Fetch the result and assign to variables
        $row = $result->fetch_assoc();
        $Playername = $row['Playername'];
        $level = $row['Level'];
        $Kills = $row['Kills'];
        $Points = $row['Points'];
        $Money = $row['Money'];
        $Clan = $row['Clan'];
        $Vehicle = $row['Vehicle'];

        // Set the content type for the image
        header('Content-Type: image/png');

        // Create an image from the PNG file
        $im = imagecreatefrompng('images/back.png');
        if (!$im) {
            die("Cannot select the correct image. Please contact the webmaster.");
        }

        // Set text color and stroke
        $text_color = imagecolorallocate($im, 0, 0, 0);
        $text_stroke = imagecolorallocate($im, 255, 255, 255);

        // Set the font file
        $font = 'fonts/font.ttf';

        // Add the text to the image with stroke
        imagettfstroketext($im, 16, 0, 22, 37, $text_color, $text_stroke, $font, "Nick: $Playername", 1);
        imagettfstroketext($im, 16, 0, 22, 60, $text_color, $text_stroke, $font, "Level: $level", 1);
        imagettfstroketext($im, 16, 0, 22, 80, $text_color, $text_stroke, $font, "Points: $Points", 1);
        imagettfstroketext($im, 16, 0, 22, 100, $text_color, $text_stroke, $font, "Clan: $Clan", 1);
        imagettfstroketext($im, 16, 0, 22, 120, $text_color, $text_stroke, $font, "Vehicle: $Vehicle", 1);

        // Output the image
        imagepng($im);
        imagedestroy($im);
    } else {
        echo 'Error: The user ID is not found in our database.';
    }

    // Close the database connection
    $conn->close();
} else {
    echo 'Error: No user ID provided.';
}

/**
 * Function to draw bold text with stroke on the image.
 * @param resource $image Image resource
 * @param int $size Font size
 * @param int $angle Font angle
 * @param int $x X coordinate
 * @param int $y Y coordinate
 * @param int $r Red color component
 * @param int $g Green color component
 * @param int $b Blue color component
 * @param string $fontfile Path to the font file
 * @param string $text The text to be drawn
 */
function drawboldtext($image, $size, $angle, $x_cord, $y_cord, $r, $g, $b, $fontfile, $text) {
    $color = imagecolorallocate($image, $r, $g, $b);
    $_x = array(1, 0, 1, 0, -1, -1, 1, 0, -1);
    $_y = array(0, -1, -1, 0, 0, -1, 1, 1, 1);
    for ($n = 0; $n <= 8; $n++) {
        imagettftext($image, $size, $angle, $x_cord + $_x[$n], $y_cord + $_y[$n], $color, $fontfile, $text);
    }
}

/**
 * Function to add stroke to the text on the image.
 * @param resource $image Image resource
 * @param int $size Font size
 * @param int $angle Font angle
 * @param int $x X coordinate
 * @param int $y Y coordinate
 * @param resource $textcolor Text color
 * @param resource $strokecolor Stroke color
 * @param string $fontfile Path to the font file
 * @param string $text The text to be drawn
 * @param int $px Stroke width
 * @return mixed
 */
function imagettfstroketext(&$image, $size, $angle, $x, $y, &$textcolor, &$strokecolor, $fontfile, $text, $px) {
    for ($c1 = ($x - abs($px)); $c1 <= ($x + abs($px)); $c1++) {
        for ($c2 = ($y - abs($px)); $c2 <= ($y + abs($px)); $c2++) {
            imagettftext($image, $size, $angle, $c1, $c2, $strokecolor, $fontfile, $text);
        }
    }
    return imagettftext($image, $size, $angle, $x, $y, $textcolor, $fontfile, $text);
}
?>
