<html itemscope itemtype="http://schema.org/Article">
    <head>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
        <script src="https://apis.google.com/js/client:platform.js?onload=start" async defer></script>
        <script>
            function start() {
                gapi.load('auth2', function () {
                    auth2 = gapi.auth2.init({
                        client_id: '<?php echo $client_id?>',
                        scope: 'https://www.googleapis.com/auth/contacts.readonly'
                    });
                });
            }
        </script>
    </head>
    <body>
        <button id="signinButton">Sign in with Google</button>
        <script>
            $('#signinButton').click(function () {
                auth2.grantOfflineAccess().then(signInCallback);
            });
        </script>
        <script>
            function signInCallback(authResult) {
                if (authResult['code']) {
                    $('#signinButton').attr('style', 'display: none');
                    
                    $.post(
                        'http://<?php echo base_url(); ?>google_login/login/authenticate', 
                        { code: authResult['code'] }
                    )
                        .done(function(d) {
                            if (d) {
                                window.location = 'http://<?php echo base_url();?>google_login/contact';
                            } else {
                                alert('An error occured: Cant get your token');
                            }
                        })
                        .fail(function(j, t, e) {
                            console.log('An error occured: ' + e);
                        });
                } else {
                    // There was an error.
                }
            }
        </script>
    </body>
</html>
