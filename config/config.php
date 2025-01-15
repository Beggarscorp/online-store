<?php
if(!defined('SITE_NAME'))
{
    define('SITE_NAME','Beggars Corporation');
}
if(!defined('BASE_URL'))
{
    define('BASE_URL','https://shop.beggarscorporation.com/');
}
if(!defined('SITE_ICON'))
{
    define('SITE_ICON', BASE_URL.'BackendAssets/assets/images/logos/footer-logo-1.png');
}
if(!defined('SITE_LOGO'))
{
    define('SITE_LOGO',BASE_URL.'BackendAssets/assets/images/logos/header-logo3.png');
}
if(!defined('CURRENT_PAGE'))
{
    define('CURRENT_PAGE', pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME));
}
if(!defined('FILE_VERSION'))
{
    define('FILE_VERSION',rand(10000,99999));
}
?>