<?php
use Phppot\Member;
session_start();
if (isset($_SESSION["username"])) {
    $username = $_SESSION["username"];
    require_once __DIR__ . '/Model/Member.php';
    $member = new Member();
    $testMember = $member->getMembers();
    //var_dump($testMember);
    session_write_close();
} else {
    // since the username is not set in session, the user is not-logged-in
    // he is trying to access this page unauthorized
    // so let's clear all session variables and redirect him to index
    session_unset();
    session_write_close();
    $url = "./index.php";
    header("Location: $url");
}

?>
<HTML>
<HEAD>
<TITLE>Welcome</TITLE>
<link href="assets/css/phppot-style.css" type="text/css"
	rel="stylesheet" />
<link href="assets/css/user-registration.css" type="text/css"
	rel="stylesheet" />
</HEAD>
<BODY>
	<div class="phppot-container">
		<div class="page-header">
			<span class="login-signup"><a href="logout.php">Logout</a></span>
		</div>
		<div class="page-content">Welcome <?php echo $username;?></div>
        <?php
            for ($row = 0; $row < count($testMember); $row++) {
            echo "<ul>";
            echo "Id :" .$testMember[$row]["id"];
            echo "| Member name :" .$testMember[$row]["username"];
            echo "| Email :" .$testMember[$row]["email"];
            echo "| Is Admin :" .$testMember[$row]["Is_Admin"];
            echo "| <a href=\"update.php?id=" .$testMember[$row]["id"];
            echo "\">Update</a>";
            echo "| <a href=\"delete.php?id=" .$testMember[$row]["id"];
            echo "\">Delete</a>";
            echo "</ul>";
            }
        ?>
	</div>
</BODY>
</HTML>
