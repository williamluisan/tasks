<html itemscope itemtype="http://schema.org/Article">
    <head>
    <script src="https://apis.google.com/js/platform.js" async defer></script>
    <meta name="google-signin-client_id" content="<?php echo $client_id; ?>">

    </head>
    <body onload="onLoad()">
        <a href="#" onclick="signOut();">Sign out</a>
        <script>
            function onLoad() {
                gapi.load('auth2', function() {
                    gapi.auth2.init();
                });
            }
            
            function signOut() {
                var auth2 = gapi.auth2.getAuthInstance();
                auth2.disconnect();
                auth2.signOut().then(function () {
                console.log('User signed out.');
                });
            }
        </script>
    </body>
</html>
