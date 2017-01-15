<?php

//include("includedfile.php");

//print_r($_POST);

$forecast = "";
$error = "";

/*
if ($_POST) {

    if ($_POST["city"]) {

        function get_http_response_code($url) {

            $headers = get_headers($url);

            return substr($headers[0], 9, 3);

        }

        if (get_http_response_code('http://www.weather-forecast.com/locations/' . $_POST["city"] . '/forecasts/latest') != "200") {

            $error = '<div class="alert alert-danger" role="alert"><p>That city could not be found.</p></div>';

        } else {

            function extract_unit($string, $start, $end)

            {
                $pos = stripos($string, $start);

                $str = substr($string, $pos);

                $str_two = substr($str, strlen($start));

                $second_pos = stripos($str_two, $end);

                $str_three = substr($str_two, 0, $second_pos);

                $unit = trim($str_three); // remove whitespaces

                return $unit;
            }

            $text = file_get_contents("http://www.weather-forecast.com/locations/" . $_POST["city"] . "/forecasts/latest");

            $unit = extract_unit($text, '<span class="phrase">', '</span>');

            // Outputs: acronym
            $forecast = '<div class="alert alert-success" role="alert"><p>' . $unit . '</p></div>';

        }

    }

}*/

if ($_POST) {

    if ($_POST["city"]) {

        $pageDocument = @file_get_contents('http://www.weather-forecast.com/locations/' . $_POST["city"] . '/forecasts/latest');

        if ($pageDocument === false) {

            $error = '<div class="alert alert-danger" role="alert"><p>That city could not be found.</p></div>';

        } else {

            function extract_unit($string, $start, $end)

            {
                $pos = stripos($string, $start);

                $str = substr($string, $pos);

                $str_two = substr($str, strlen($start));

                $second_pos = stripos($str_two, $end);

                $str_three = substr($str_two, 0, $second_pos);

                $unit = trim($str_three); // remove whitespaces

                return $unit;
            }

            $text = file_get_contents('http://www.weather-forecast.com/locations/' . $_POST["city"] . '/forecasts/latest');

            $unit = extract_unit($text, '<span class="phrase">', '</span>');

            $forecast = '<div class="alert alert-success" role="alert"><p>' . $unit . '</p></div>';

        }

    }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags always come first -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Weather Scraper</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/css/bootstrap.min.css" integrity="sha384-y3tfxAZXuh4HwSYylfB+J125MxIs6mR5FOHamPBG064zB+AFeWH94NdvaCBm8qnd" crossorigin="anonymous">

    <style type="text/css">
        html {
            background: url(https://images.unsplash.com/photo-1462726625343-6a2ab0b9f020?ixlib=rb-0.3.5&q=80&fm=jpg&crop=entropy&s=eb6506972ee7685166b2d8b649d29a1b)no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }

        body {
            background: none;
        }

        .container {
            margin-top: 10rem;
        }

        .alert {
            margin-top: 1rem;
        }
    </style>

</head>

<body>

    <div class="container text-xs-center">

        <h1><strong>What's The Weather?</strong></h1>
        <p class="lead">Enter the name of a city.</p>

        <form method="post">

            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <input type="text" class="form-control" id="city" name="city" placeholder="Eg. London, Tokyo">
                </div>
            </div>

            <br>
            <button type="submit" class="btn btn-primary">Submit</button>

        </form>

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <?php echo $error.$forecast; ?>
            </div>
        </div>

    </div>

    <!-- jQuery first, then Bootstrap JS. -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/js/bootstrap.min.js" integrity="sha384-vZ2WRJMwsjRMW/8U7i6PWi6AlO1L79snBrmgiDpgIWJ82z8eA5lenwvxbMV1PAh7" crossorigin="anonymous"></script>
</body>

</html>
