<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Laracast</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.4/css/bulma.css" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
    @stack('styles')
</head>
<body>
   
    <section class="section">
        <div class="container">
            @yield('content')
        </div>
    </section>
    
            
        
    
    @stack('scripts')
</body>
</html>