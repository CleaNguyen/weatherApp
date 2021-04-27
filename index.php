<?php

    $weather = "";
    $error = "";

    if ($_GET['city']) {
    

    $urlContents = file_get_contents("http://api.openweathermap.org/data/2.5/weather?q=".urlencode($_GET['city'])."&appid=607e228e245c5b380a2f7a47ee2d69f4");    

    $weatherArray = json_decode($urlContents, true);
    
    
        if ($weatherArray['cod'] == 200) {
    
    $weather = "The weather in ".$_GET['city']." is currently '".$weatherArray['weather'][0]['description']."'. ";
    
    $tempInCelcius = intval($weatherArray['main']['temp'] - 273);
    
    $weather .= " The temperature is ".$tempInCelcius."&deg;C and the wind speed is ".$weatherArray['wind']['speed']."m/s.";
    
    } else {
        
        $error = "Could not find city, please try again.";
    }
}

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <title>Weather Scraper</title>
    
    <style>
        
        body {
            background-image:url(https://images.unsplash.com/photo-1475113548554-5a36f1f523d6?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=1534&q=80);
        }
        
        #main {
            margin-top: 100px;
            width: 550px;
        }
        
        input {
            margin: 20px 0px;
        }
        
        #weather {
            margin-top: 15px;
        }
        
    </style>
    
  </head>
  <body>
      
      <div class= "container text-center" id="main">
  <h1 class="display-4">What's the weather?</h1>
  
  <form>
  <div class="form-group">
    <label for="city">Enter the name of a city</label>
    <input type="city" class="form-control" id="city" name="city" placeholder="Eg. London, Tokyo" value = "<?php echo $_GET['city'];?>">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
  
  <div id="weather">
      <?php 
      
      if ($weather) {
          
          echo '<div class="alert alert-success" role="alert">
  '.$weather.'
</div>';
      } else if ($error) {
          
          echo '<div class="alert alert-danger" role="alert">
  '.$error.'
</div>';
          
          
          
          
      }
      
      ?>
  </div>
  
</div>
      

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
  </body>
</html>
