<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Laracast</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.4/css/bulma.css" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
        <meta name="csrf-token" content="{{ csrf_token() }}">

    @stack('styles')
</head>
<body>
    
    
            @yield('content')
        
    
    @stack('scripts')
</body>
</html>