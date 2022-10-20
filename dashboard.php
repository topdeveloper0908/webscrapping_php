<?php
    require('db.php');
    include("auth_session.php");
    include("get_urls.php");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Dashboard - Client area</title>
    <link rel="stylesheet" href="style.css" />
    <script src="js/jquery.min.js"></script>
</head>
<body>
    <div class="form main">
        <div class="header">
            <h3><?php echo $_SESSION['username']; ?></h3>
            <h2>Dashboard</h2>
            <p><a href="logout.php">Logout</a></p>
        </div>
        <div class="content">
            <form id="addurl-form" class="add_url" action="add_url.php" method="post">
                <div>
                    <h2 class="login-title">Add new URL</h2>
                    <?php
                        if($url_count < 10) 
                            echo "<button type='submit' id='submit-button'>Add URL</button>";
                        else
                            echo "<button class='disable' type='submit' id='submit-button'>Add URL</button>";
                    ?>
                </div>
                <div style="margin-right: -1rem; margin-left: -1rem;">
                    <input type="text" class="login-input" name="address" placeholder="URL" required />
                    <input type="text" class="login-input" name="domain_address" placeholder="Domain">
                </div>
            </form>
            <div>
                <table id="url_table">
                    <tr>
                        <th style="width:2%">No</th>
                        <th style="width:55%">URL</th>
                        <th style="width:30%">Domain</th>
                        <th style="width:1%">status</th>
                        <th>Action</th>
                    </tr>
                    <?php
                        $i=1;
                        while($url = mysqli_fetch_assoc($url_rows)) {
                            // Display the table
                            // $headers = @get_headers($url['url']);  
                            // // Use condition to check the existence of URL
                            // if($headers && strpos( $headers[0], '200')) {
                            //     $status = "ON";
                            // }
                            // else {
                            //     $status = "OFF";
                            // }
                            echo "<tr class='row_col'><td>". $i ."</td><td class='site_link'><a href='".$url['url']."'>". $url['url'] ."</a></td><td>" .$url['domain']. "</td><td class='url_status'></td><td><button onClick='removeRow(" . $url['id'] . ")' number=" . $url['id'] . ">Delete</button></td></tr>";
                            $i++;
                        }
                    ?>
                </table>
            </div>
        </div>
    </div>
    <script>
        $("document").ready(function(e) {
            isValidURL();
            myInterval = setInterval(() => {
                isValidURL();
            }, 300000);
         
        });
        $("#submit-button").click(function(e) {
            e.preventDefault();
            var form = $("#addurl-form");
            var url = form.attr('action');
            var address = form.serializeArray()[0].value;
            var domain = form.serializeArray()[1].value;
            var id = <?php echo json_encode($_SESSION['id']);?>;
            if(address != '') {
                $.ajax({
                    type: "POST",
                    url: url,
                    data: 'id=' + id + '&address='+ address + '&domain' + domain,
                    success: function(data) {
                        // Ajax call completed successfully\
                        window.location='dashboard.php';
                    },
                    error: function(data) {
                        // Some error in ajax call
                        alert("some Error");
                    }
                });
            }
            else {
                alert("Plz fill the form");
            }
        });
        function removeRow(id) {
            console.log(id);
            $.ajax({
                type: "POST",
                url: 'remove.php',
                data: 'id=' + id,
                success: function(data) {
                    // Ajax call completed successfully\
                    window.location='dashboard.php';
                },
                error: function(data) {
                    // Some error in ajax call
                    alert("some Error");
                }
            });
        }
        function isValidURL(url) {
            $(".url_status").each(function() {
                link = $(this).siblings('.site_link').children().attr('href');
                $(this).append("ON");
            });
        }
        
    </script>
</body>
</html>