<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>maps</title>
    <link rel="icon" href="images/logo_pasabuy.png"" type="image/icon type">
</head>
<body>
    <div id="map"></div>
        <script>
        function initMap() {
            var location = {lat: -25.363, lng: 131.044};
            var map = new google.maps.Map(document.getElementById("map"), {
                zoom: 14,
                center: location
            });
            var marker = new google.maps.Marker({
            position: location,
            map: map
              });
        }


        </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDaIMMvjxvVokNslg3ZSO1W_AGMYfxSv0A&callback=initMap"></script
</body>
</html>
