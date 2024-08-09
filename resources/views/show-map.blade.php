<!DOCTYPE html>
<html lang=" str_replace('_', '-', app()->getLocale()) ">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Google Map with Multiple Marker and Info Box in Laravel - CodeSolutionStuff </title>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
    <link href="//netdna.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" />

</head>

<body class="antialiased">
    <div class="container">
        <!-- main app container -->
        <div class="readersack">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 ">
                        <h3>Google Map with Multiple Marker and Info Box in Laravel - CodeSolutionStuff </h3>
                        <div id="map" style='height:400px'></div>

                    </div>
                </div>
            </div>
        </div>
        <!-- credits -->
        <div class="text-center">
            <p>
                <a href="#" target="_top">Google Map with Multiple Marker and Info Box in Laravel
                </a>
            </p>
            <p>
                <a href="https://www.codesolutionstuff.com" target="_top">CodeSolutionStuff.com</a>
            </p>
        </div>
    </div>

</body>
<script type="text/javascript">
    function initializeMap()
        const locations = <?php echo json_encode($locations) ?>;

        const map = new google.maps.Map(document.getElementById("map"));
        var infowindow = new google.maps.InfoWindow();
        var bounds = new google.maps.LatLngBounds();
        for (var location of locations)
            var marker = new google.maps.Marker(
                position: new google.maps.LatLng(location.lat, location.lng),
                map: map
            );
            bounds.extend(marker.position);
            google.maps.event.addListener(marker, 'click', (function(marker, location)
                return function()
                    infowindow.setContent(location.lat + " & " + location.lng);
                    infowindow.open(map, marker);

            )(marker, location));


        map.fitBounds(bounds);

</script>

<script type="text/javascript" src="https://maps.google.com/maps/api/js?key=AIzaSyAXNZ_3RuqOTo0lwcMl7sSHHt8JgB2KfMI&callback=initializeMap"></script>


</html>
