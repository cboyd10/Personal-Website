<?php
$errorMessage = "";
$successMessage = "";
if($_POST) {
    if (!$_POST["email"]) {
        $errorMessage .= "Invalid email address<br>";
    }
    if (!$_POST["fname"] || !$_POST["lname"] || !$_POST["message"]) {
        $errorMessage .= "All fields are required";
    }
    $email = $_POST["email"];
    if ($_POST["email"] && filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
        $errorMessage .= "Invalid email address<br>";
    }
    if ($errorMessage != "") {
        $errorMessage = '<div class="alert alert-danger" role="alert"><p><strong>Oops! </strong></p>' . $errorMessage . '</div>';
    } else {
        $emailTo = "support@boydchris.com";
        $subject = "Support";
        $body = $_POST["fname"].' '.$_POST["lname"]." says:\n\n".$_POST["message"];
        $headers = $_POST["email"];
        if (mail($emailTo, $subject, $body, $headers)) {
            $successMessage = '<div class="alert alert-success" role="alert"><p><strong>Message sent successfully!</strong></p></div>';
        } else {
            $errorMessage = '<div class="alert alert-danger" role="alert"><p><strong>Error: </strong></p>Oh, no! The message could not be sent at this time.<br> Please try again!</div>';
        }
    }
}
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
        <link rel="manifest" href="/manifest.json">
        <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
        <meta name="theme-color" content="#ffffff">
        <meta http-equiv="ScreenOrientation" content="autoRotate:disabled">
        <link href="https://fonts.googleapis.com/css?family=Kaushan+Script|Source+Code+Pro:300,400,900|Noto+Sans:400,700" rel="stylesheet">
        <title>Chris Boyd</title>
        <link rel="stylesheet" href="css/styles.css">
    </head>

    <body>
        <section id="contact">
            <div class="container" id="contact_container">
                <span class="shadow2" id="contact-text">Get In Touch</span>
                <form id="contact_form" action="contact.php" method="POST">
                    <div id="errorMessage">
                        <?php echo $errorMessage.$successMessage; ?>
                    </div>
                    <label id="nameLabel">Name *</label>
                    <br>
                    <input id="fname" type="text" name="fname">
                    <input id="lname" name="lname">
                    <br>
                    <span>First Name</span>
                    <span id="lname_span">Last Name</span>
                    <br>
                    <label id="emailLabel">Email *</label>
                    <br>
                    <input id="email" type="email" name="email">
                    <br>
                    <span>We’ll never share your email with anyone else.</span>
                    <br>
                    <label id="messageLabel">Message *</label>
                    <br>
                    <textarea rows="3" name="message"></textarea>
                    <br>
                    <input id="submit-btn" type="submit" value="SEND">
                </form>
            </div>
        </section>
        <script src="js/jquery-3.2.1.min.js"></script>
        <script>
            $(document).ready(function () {
                        $(window).bind("pageshow", function (event) {
                            if (event.originalEvent.persisted) {
                                window.location.reload()
                            }
                        });

                        $("form").submit(function (e) {
                                var errorMessage = "";
                                if ($("#email").val() == "") {
                                    errorMessage += "Invalid email address<br>";
                                }
                                if (($("#fname").val() == "") || ($("#lname").val() == "") || ($("#message").val() ==
                                        "")) {
                                    errorMessage += "All fields are required";
                                }
                                if (errorMessage != "") {
                                    $("#errorMessage").html(
                                        // '<div class="alert alert-danger"><p><strong>Oops! </strong></p>' +
                                        // errorMessage + '</div>');
                                        return false;
                                    }
                                    else {
                                        return true;
                                    }
                                });
                        });
        </script>
    </body>

    </html>