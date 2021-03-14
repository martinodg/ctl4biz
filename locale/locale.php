<?php
define('DEFAULT_LOCALE_INDEX',1);
define('DEFAULT_LOCALE_DOMAIN','ctl4biz');
define('DEFAULT_LOCALE_DIRECTORY',realpath(__DIR__));
//check session
if(session_id() == '') {
    session_start();
}
//
$domain = DEFAULT_LOCALE_DOMAIN;
$locales = array('en_US.UTF-8', 'es_AR.UTF-8' );
if(empty($_SESSION['locale_index'])) {
    $_SESSION['locale_index'] = DEFAULT_LOCALE_INDEX;
    $locale  = $locales[DEFAULT_LOCALE_INDEX] ;
}else {
    $locale = $locales[$_SESSION['locale_index']];
}
$results = putenv("LC_ALL=$locale");
if (!$results) {
    throw new ErrorException('Locale putenv failed');
}

$results = setlocale(LC_ALL, $locale,'spanish');
if (!$results) {
    throw new ErrorException('Setlocale failed: locale function is not available on this platform, or the given local does not exist in this environment');
}
$results = bindtextdomain($domain, DEFAULT_LOCALE_DIRECTORY);
echo 'new text domain is set: ' . $results.' on '.$locale. "\n<br/>";
$results = textdomain($domain);
echo 'current message domain is set: ' . $results. "\n<br/>";

function testlocale()
{
    $results = gettext("Test locale");
    if ($results === "Test locale") {
          echo "Original English was returned. Something wrong\n<br/>";
    }
    echo $results . "\n<br/>";
    die();
}
