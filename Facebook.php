<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Get Current Location</title>
</head>
<body>
    <h1>Your Current Location</h1>
    <p id="location"></p>

    <script>
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        } else {
            document.getElementById("location").innerHTML = "Geolocation is not supported by this browser.";
        }

        function showPosition(position) {
            var latitude = position.coords.latitude;
            var longitude = position.coords.longitude;

            // Gọi hàm để lấy địa chỉ từ vị trí hiện tại
            getAddressFromCoordinates(latitude, longitude);
        }

        function getAddressFromCoordinates(latitude, longitude) {
            var apiKey = 'YOUR_GOOGLE_MAPS_API_KEY';
            var apiUrl = `https://maps.googleapis.com/maps/api/geocode/json?latlng=${latitude},${longitude}&key=${apiKey}`;

            fetch(apiUrl)
                .then(response => response.json())
                .then(data => {
                    // Lấy địa chỉ từ data
                    var address = data.results[0].formatted_address;
                    document.getElementById("location").innerHTML = address;
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }
    </script>
</body>
</html>
