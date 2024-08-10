<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite('resources/css/app.css')
  @vite('resources/js/app.js')

  <style scoped>
    @keyframes pulse{
      0%{
        transform: scale(1);
      }
      50%{
        transform: scale(1.1);
      }
      100%{
        transform: scale(1);
      }
    }
    .pulse{
      animation: pulse 2s infinite;
    }


    .weather-icon {
    width: 40px;
    height: 40px;
}

.rotate {
    animation: rotate 5s linear infinite;
}

.pulse {
    animation: pulse 1.5s infinite;
}

@keyframes rotate {
    0% {
        transform: rotate(0deg);
    }
    100% {
        transform: rotate(360deg);
    }
}

@keyframes pulse {
    0% {
        transform: scale(1);
    }
    50% {
        transform: scale(1.1);
    }
    100% {
        transform: scale(1);
    }
}


  </style>
  <title>Weather app</title>
</head>
<body class="bg-blue-300">
    <div id="app" class="flex justify-center pt-16">
        <weather-app></weather-app>
    </div>
</body>
</html>