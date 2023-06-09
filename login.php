<?php
session_start();
if (!isset($_SESSION["oauth_demo"])) {
    $_SESSION["oauth_demo"] = array("ingelogd"=>false);
}

$oAuthAppName = "photografie";
$oAuthLoginUrl = "https://www.go-atheneumoudenaarde.be/dashboard/oAuthLogin.php";
$oAuthGetUserInfoUrl = "https://www.go-atheneumoudenaarde.be/dashboard/oAuthGetUserInfo.php";

$epayAppName = "photografie";
$epayPassword = "demo";
$epayLoginUrl = "https://www.go-atheneumoudenaarde.be/epay/public/api/login_check";
$epayPayUrl = "https://www.go-atheneumoudenaarde.be/epay/public/api/pay";

// De gebruiker wil inloggen
if (isset($_GET["login"])) {
    // redirect naar login pagina, dit kan enkel als je een geldige appName hebt
    header("Location: ".$oAuthLoginUrl. "?app=" .$oAuthAppName);
}
// De gebruiker wil uitloggen
if (isset($_GET["logout"])) {
    // redirect naar login pagina, dit kan enkel als je een geldige appName hebt
    $_SESSION["oauth_demo"] = array("ingelogd"=>false);
    header("Location: oauth_demo.php");
}

// de gebruiker is op smartschool ingelogd, we vragen de gegevens van de gebruiker op
if (isset($_GET["code"])) {
    $userToken = $_GET["code"];
    $dataJson = json_encode(array("app" => $oAuthAppName, "code" => $userToken));
    $options = array(
        'Content-Type: application/json',
        'Content-Length: '. strlen($dataJson)
    );
    $ch = curl_init($oAuthGetUserInfoUrl);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $dataJson);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $options);

    $result = curl_exec($ch);
    $result = json_decode($result, true);

    // gebruiker is ingelogd, we slaan alle info op in een sessie
    $_SESSION["oauth_demo"]["ingelogd"] = true;
    $_SESSION["oauth_demo"]["voornaam"] = $result["voornaam"];
    $_SESSION["oauth_demo"]["naam"] = $result["naam"];
    $_SESSION["oauth_demo"]["klas"] = $result["klas"];
    $_SESSION["oauth_demo"]["userToken"] = $userToken;
    header("Location: oauth_demo.php");
}

$gebruikerIsIngelogd = $_SESSION["oauth_demo"]["ingelogd"];
if ($gebruikerIsIngelogd) {
    $naam = $_SESSION["oauth_demo"]["naam"];
    $voornaam = $_SESSION["oauth_demo"]["voornaam"];
    $klas = $_SESSION["oauth_demo"]["klas"];
    $message = isset($_SESSION["oauth_demo"]["message"]) ? $_SESSION["oauth_demo"]["message"] : "";
    unset($_SESSION["oauth_demo"]["message"]);
}
?>
<html>
<head>
    <title>Demo</title>
</head>
<body>
    <?php if ($gebruikerIsIngelogd) : ?>
        <p>welkom <?php echo $voornaam; ?> <?php echo $naam; ?> uit de klas <?php echo $klas; ?>(<a href="oauth_demo.php
?logout=1">logout</a>)</p>
        <?php if ($message != ""): ?>
            <p style="color:red"><?php echo $message; ?></p>
        <?php else: ?>
            <?php header("Location: index.php"); ?>
        <?php endif; ?>
    <?php else: ?>
        <?php header("Location: oauth_demo.php?login=1") ;?>
        <p>Je bent niet ingelogd</p>
        <p><a href="oauth_demo.php?login=1">Login</a></p>
    <?php endif; ?>
</body>
</html>