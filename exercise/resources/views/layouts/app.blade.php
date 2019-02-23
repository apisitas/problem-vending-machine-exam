<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.3/css/uikit.min.css" />
        <title>Laravel</title>
    </head>
    <body>
        <div class="uk-container">
            <h1 align="center" class="uk-margin-bottom uk-margin-top">Vending Machine System</h1>
            <div uk-grid uk-height-match="target: > div > .uk-card; row: false">
                <div class="uk-width-expand">
                    @yield('content')
                </div>
            </div>
        </div>
    </body>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.3/js/uikit.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.3/js/uikit-icons.min.js"></script>
</html>
