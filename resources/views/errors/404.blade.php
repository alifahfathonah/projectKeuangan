<html lang="en"><head>        
        <!-- META SECTION -->
        <title>404 | Not Found</title>            
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <link rel="icon" href="favicon.ico" type="image/x-icon">
        <!-- END META SECTION -->
        
        <!-- CSS INCLUDE -->        
        <link rel="stylesheet" type="text/css" id="theme" href="{{ asset('/admin/css/theme-default.css')}}"/>
        <!-- EOF CSS INCLUDE -->                                     
    </head>
    <body>
        <div class="error-container">
            <div class="error-code">404</div>
            <div class="error-text">page not found</div>
            <div class="error-subtext">Unfortunately we're having trouble loading the page you are looking for. Please wait a moment and try again or use action below.</div>
            <div class="error-actions">                                
                <div class="row">
                    <div class="col-md-6">
                        <button class="btn btn-info btn-block btn-lg" onclick="document.location.href = '/home';">Back to dashboard</button>
                    </div>
                    <div class="col-md-6">
                        <button class="btn btn-primary btn-block btn-lg" onclick="history.back();">Previous page</button>
                    </div>
                </div>                                
            </div>
            
            <div class="row">
                
            </div>
        </div> 
</body>
</html>