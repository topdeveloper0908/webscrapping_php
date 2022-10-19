<?php
    require('db.php');
    include("auth_session.php");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Dashboard - Client area</title>
    <link rel="stylesheet" href="style.css" />
</head>
<body>
    <div class="form main">
        <div class="header">
            <h3><?php echo $_SESSION['username']; ?></h3>
            <h2>Dashboard</h2>
            <p><a href="logout.php">Logout</a></p>
        </div>
        <div class="content">
            <form class="add_url" action="" method="post">
                <div>
                    <h2 class="login-title">Registration</h2>
                    <button type="submit">Add URL</button>
                </div>
                <div style="margin-right: -1rem; margin-left: -1rem;">
                    <input type="text" class="login-input" name="address" placeholder="URL" required />
                    <input type="text" class="login-input" name="domain_address" placeholder="Domain">
                </div>
            </form>
        </div>
    </div>
</body>
</html>