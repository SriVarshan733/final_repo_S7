<!DOCTYPE html>
<!-- Coding By CodingNepal - www.codingnepalweb.com -->
<html lang="en">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/weather.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="js/weather.js" defer></script>
  </head>
  <body>
  <center><h2><i class='bx bx-cloud-drizzle' ></i>Forecast</h2></center>
  <div class="outline-box">
    <div class="container">
      <div class="weather-input">
        <h3>Enter a City Name</h3>
        <input class="city-input" type="text" placeholder="E.g., Chennai, Mumbai, Delhi">
        <button class="search-btn">Search</button>
        <div class="separator"></div>
        <button class="location-btn">Use Current Location</button>
      </div>
      <div class="weather-data">
        <div class="current-weather">
          <div class="details">
            <h2>_______ ( ______ )</h2>
            <h6>Temperature: __°C</h6>
            <h6>Wind: __ M/S</h6>
            <h6>Humidity: __%</h6>
          </div>
        </div>
        <div class="days-forecast">
          <h2>5-Day Forecast</h2>
          <ul class="weather-cards">
            <li class="card">
              <h3>( ______ )</h3>
              <h6>Temp: __C</h6>
              <h6>Wind: __ M/S</h6>
              <h6>Humidity: __%</h6>
            </li>
            <li class="card">
              <h3>( ______ )</h3>
              <h6>Temp: __C</h6>
              <h6>Wind: __ M/S</h6>
              <h6>Humidity: __%</h6>
            </li>
            <li class="card">
              <h3>( ______ )</h3>
              <h6>Temp: __C</h6>
              <h6>Wind: __ M/S</h6>
              <h6>Humidity: __%</h6>
            </li>
            <li class="card">
              <h3>( ______ )</h3>
              <h6>Temp: __C</h6>
              <h6>Wind: __ M/S</h6>
              <h6>Humidity: __%</h6>
            </li>
            <li class="card">
              <h3>( ______ )</h3>
              <h6>Temp: __C</h6>
              <h6>Wind: __ M/S</h6>
              <h6>Humidity: __%</h6>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  </body>
  <br></br>
</html>