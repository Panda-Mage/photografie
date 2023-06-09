<?php 
    session_start();
    $counter = isset($_SESSION["items"])  ? count($_SESSION["items"]) : 0;

    if( $_SESSION["oauth_demo"]["ingelogd"] != true){
        header("Location: login.php");
    }
?>
<html>
    <head>
        <link rel="stylesheet" href="css/index.css">
        <link rel="stylesheet" href="css/main.css">
        <link rel="icon" href="foto's/custom_foto's/gosnapit.png">
        <title>Homepagina</title>

        <style>
            .container_content {
                height: 84%;
            }
        </style>
    </head>
    <body>
    
        <div class="main">

            <nav>
                <a href="index.php"><p>HOME</p></a>
                <a href="photos.php"><p>FOTO'S</p></a>
                <a href="winkelMandje.php"><img src="foto's/custom_foto's/winkelMandje.png"><p id="counter"><?php echo $counter ?></p></a> 
            </nav>

            <div class="container_content">
                <div class="container_content_border">
                    <div id="headtag">
                        <h1>PHOTOGRAFIE</h1>
                        <h2>GO SNAP IT</h2>
                    </div>
                    <div class="container_text alignCenter">
                        <h1>OVER ONS:</h1>
                        <p>Wij zijn 4 enthousiaste junior ondernemers van de richting 6 Informaticabeheer en realiseren dit schooljaar de klasfoto's.</p>
                        <p>Via deze website kunt u de klasfoto(s) van uzelf of uw zoon/dochter bestellen. Dit project hebben wij kunnen realiseren dankzij het  <a href="https://bezoek.go-atheneumoudenaarde.be/" target="_new">GO Atheneum Oudenaarde</a> en <a href="https://www.vlajo.org/" target="_new">Vlajo (Vlaamse Jonge Ondernemingen)</a></p>
                        <button onclick="location.href='photos.php'" style="cursor: pointer;"><b>NAAR FOTO'S<b></button>
                    </div>
                </div>
            </div>

            <div class="footer">
                <div class="verticalAlign">
                    <img src="foto's/custom_foto's/button_onder_toezicht_van_Vlajovzw_HR.jpg" >
                    <img src="foto's/custom_foto's/go-ao_logo.png">
                </div>
            </div>

        </div>

    </body>
</html>