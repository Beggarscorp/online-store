
<?php


// website setting

if(!defined('SITE_NAME'))
{
    define('SITE_NAME','Beggars Corporation');
}
if(!defined('BASE_URL'))
{
    define('BASE_URL','http://localhost:3000/');
}
if(!defined('SITE_ICON'))
{
    define('SITE_ICON', 'https://beggarscorporation.com/images/main/favicon.png');
}
if(!defined('SITE_LOGO'))
{
    define('SITE_LOGO','https://beggarscorporation.com/images/main/header-logo3.png');
}
if(!defined('CURRENT_PAGE'))
{
    define('CURRENT_PAGE', pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME));
}
if(!defined('FILE_VERSION'))
{
    define('FILE_VERSION',rand(10000,99999));
}

// api keys


// file upload 

?>