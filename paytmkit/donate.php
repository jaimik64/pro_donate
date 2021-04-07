<?php setcookie("cat",$_POST['cat']);?>
<html>
    <head>
        <title>Donate</title>
        <link rel="stylesheet" href="s2.css">
        <link rel="icon" href="heart.png">
        <style>
            .dnt{
                height:300px ;width:350px;
                align:center;
                border-radius:10px; margin-top:150px;margin-left:550px;
                background-image:url("donation.png");
                background-size:300px 350px;
                background-repeat:no-repeat;
            }
            a{
                color:white;
                text-decoration:none;
                margin-left:10px;
            }
            .menu{
                background-color:white;
                opacity:0.7;
                
            }
        </style>
    </head>
<body>
    <div class="menu">
        <a href="donar.php" style="color:blue;">Home</a>
        <a href="donarp.php" style="color:blue;">Profile</a>
        <a href="donation_log.php" style="color:blue;">Donation Log</a>
        <a href="suppport.php" style="color:blue;">Support</a>
    </div>
    <form method="get" action="paytmkit/TxnTest.php">
  
    <input type="submit" value="donate here" name="submit" class="dnt">
   
    </form>
     <a href="viewdonee.php">View Request List?</a>
</body>
</html>