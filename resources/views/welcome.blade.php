<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Smarty Street API Demo</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" />
        <link rel="stylesheet" href="/css/app.css" />
        <style>
            body,html {
                margin: 0 auto;
                width: 100%;
                max-width: 1090px;
            }
            body {
                margin-top: 30px;
            }
        </style>
    </head>
    <body>
        <div id="app">
            <address-component></address-component>
        </div>
    </body>
    <script src="{{ mix('js/app.js') }}"></script>
</html>
