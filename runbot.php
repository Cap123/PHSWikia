<?php
/*
 * PHSWikia
 * By Cap123
 */

$username = $_POST['username'];
$password = $_POST['password'];
$wiki = $_POST['wiki'];
$wikiasite = $wiki . $dot . wikia . $dot . com;
$slash = '/';
$dot = '.';
$pagesdir = $wikiasite . $slash . 'wiki' . $slash;
$pagestoedit = $_POST['pages'];
$pagesdirtoedit = $pagesdir . $pagestoedit;
$n2 = $slash . 'wiki' . $slash;
$loginPage = 'Special:UserLogin';
$summary = $_POST['summary'];
$content = $_POST['content'];

$logfile = 'logs.txt';
$text = file_get_contents($logfile);
$text .= "Logged on as" . $username . "\n";
file_put_contents($logfile, $text, FILE_APPEND | LOCK_EX);

set_cookie("PHSWikia By Cap123", "PHSWikia", $cookie-expire);
$cookie-expire = time()+5;
?>
<!DOCTYPE html>
<html>
<head>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" />
<script>
function wiki_auth(login, pass, ref){
    $.post('/w/api.php?action=login&lgname=' + login + 
            '&lgpassword=' + pass + '&format=json', function(data) {
        if(data.login.result == 'NeedToken') {
            $.post('/w/api.php?action=login&lgname=' + login + 
                    '&lgpassword=' + pass + '&lgtoken='+data.login.token+'&format=json', 
                    function(data) {
                if(!data.error){
                   if (data.login.result == "Success") { 
                        document.getElementById('log0').innerHTML = '<p>Logging in as ' + login + '</p>'; 
                        document.getElementById('log1').innerHTML = '<p>Successfully Logged in!</p>';
                   } else {
                        console.log('Result: '+ data.login.result);
                   }
                } else {
                   console.log('Error: ' + data.error);
                }
            });
        } else {
            console.log('Result: ' + data.login.result);
        }
        if(data.error) {
            console.log('Error: ' + data.error);
        }
    });
}
function addNewSection( summary, content, editToken, ) {
    $.ajax({
        url: mw.util.wikiScript( 'api' ),
        data: {
            format: 'json',
            action: 'edit',
            title: mw.config.get( 'wgPageName' ),
            section: 'new',
            summary: summary,
            text: content,
            token: editToken
        },
        dataType: 'json',
        type: 'POST',
        success: function( data ) {
            if ( data && data.edit && data.edit.result == 'Success' ) {
            document.getElementById('log2').innerHTML = '<p>Editing page...</p>';
            } else if ( data && data.error ) {
                alert( 'Error: API returned error code "' + data.error.code + '": ' + data.error.info );
            } else {
                alert( 'Error: Unknown result from API.' );
            }
        },
        error: function( xhr ) {
            alert( 'Error: Request failed.' );
        }
    });
}
function getEditToken() {
    $.getJSON(
        'wikia.com' + '/api.php?',
        {
            action: 'tokens',
            type: 'edit',
            format: 'json'
        },
        function( data ) {
            if ( data.tokens ) {
                wgEditToken = data.tokens.edittoken;
            }
        }
    )
}
</script>
<script>
$(document).ready(function(){
            wiki_auth('<?php echo $username; ?>', '<?php echo $password; ?>', '/w/');
            addNewSection('<?php echo $summary; ?>', '<?php echo $content; ?>', getEditToken());
});
</script>
<link rel='stylesheet' href='http://cptricks.tk/CPTPS/style.css' />
<title>Running Bot -- PHSWikia By Cap123</title>
</head>
<body>
<header>
<h1>Running Bot!</h1>
</header>
<content>
<h2>Actions</h2>
<div id="log0"></div>
<div id="log1"></div>
<div id="log2"></div>
</content>
</body>
</html>
