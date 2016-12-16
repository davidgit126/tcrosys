<?php

$debugIP = "68.68.42.225";

date_default_timezone_set("US/Arizona");

define("APPDIR", __DIR__.'/../silex');

//button border color
$btn_bordercolor = "#3187b3";

//button background color
$btn_bgcolor = "#3893c2";

//button background image color start gradient view
$btn_bgimagestartcolor = "#3893c2";

//button background image color end gradient view
$btn_bgimageendcolor = "#2e83ae";

//button hover border color
$btn_hov_bordercolor = "#185575";

//button hover background color
$btn_hov_bgcolor = "#287197";

//button hover background image color start gradient view
$btn_hov_bgimagestartcolor = "#287197";

//button hover background image color end gradient view
$btn_hov_bgimageendcolor = "#1f6487";

@include_once('common.inc.php');
require_once(APPDIR . '/vendor/autoload.php');

use Doctrine\DBAL\Types\Type;
use Doctrine\DBAL\Schema\Table;
use Symfony\Component\HttpKernel\Debug\ErrorHandler;
use Symfony\Component\HttpKernel\Debug\ExceptionHandler;
use Symfony\Component\Translation\Loader\YamlFileLoader;
use Services\Encrypt\AceEncrypt;
use Services\LanguageTrans;
use Services\LongBlobType;
use Services\InsertAccountRecord;
use Services\ClientStatusRecord;
use Silex\Provider\FormServiceProvider;

$app = new Silex\Application();

$app['debug'] = false;

if ($_SERVER['REMOTE_ADDR'] == $debugIP)
{
    $app['debug'] = true;
    ini_set('error_reporting', E_ALL & ~E_NOTICE & ~E_WARNING);
    error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
    /*ErrorHandler::register();
    if ('cli' !== php_sapi_name()) {
        ExceptionHandler::register();
    }*/
}

// Registering
$app->register(new FormServiceProvider());

$app->register(new Silex\Provider\SessionServiceProvider());

$app->register(new Silex\Provider\MonologServiceProvider(), array(
    'monolog.logfile' => APPDIR . '/development.log',
));

$app->register(new Silex\Provider\UrlGeneratorServiceProvider());

$app->register(new Ziadoz\Silex\Provider\CapsuleServiceProvider, [
    'capsule.connection' => [
        'driver'    => 'mysql',
        'host'      => $db_settings['host'],
        'database'  => $db_settings['dbname'],
        'username'  => $db_settings['user'],
        'password'  => $db_settings['password'],
        'charset'   => 'utf8',
        'collation' => 'utf8_unicode_ci',
        'prefix'    => '',
        'logging'   => true,
    ],
]);
$app->register(new Silex\Provider\DoctrineServiceProvider(), array(
    'dbs.options' => array(
        'mysql' => array(
            'driver' => 'pdo_mysql',
            'host' => $db_settings['host'],
            'dbname' => $db_settings['dbname'],
            'user' => $db_settings['user'],
            'password' => $db_settings['password'],
            'charset' => 'utf8',
        ),
        '700score' => array(
            'driver' => 'pdo_mysql',
            'host' => 'localhost',
            'dbname' => 'score700_dealer',
            'user' => 'score700_dealer',
            'password' => 'c@mpasano',
            'charset' => 'utf8',
        ),
        'htdi' => array(
            'driver' => 'pdo_mysql',
            'host' => 'localhost',
            'dbname' => 'htdi_myaccount',
            'user' => 'htdi_myaccount',
            'password' => 'dabaichi47%',
            'charset' => 'utf8',
        ),
    ),
));

$typesMap = Type::getTypesMap();
Type::addType('longblob', 'Services\LongBlobType');
$app['dbs']['mysql']->getDatabasePlatform()->registerDoctrineTypeMapping('longblob', 'longblob');

$app['migratedDomain'] = true;
/*$migratedDomains = trim(file_get_contents("/home/gateway1/silex/migrated_domains")).",PLACEHOLDERXXX";
$migratedDomains = explode(",", $migratedDomains);
$http_name = str_replace("www.", "", $_SERVER['HTTP_HOST']);
$http_name = substr($http_name, 0, strpos($http_name, "."));
if (in_array($http_name, $migratedDomains)) {
    $app['migratedDomain'] = true;
}*/

$app['ace_encrypt'] = function ()  {
    return new AceEncrypt(); // inject the app on initialization
};
$app['insert_account_rec'] = function ()  {
    return new InsertAccountRecord(); // inject the app on initialization
};
$app['client_status_rec'] = function ()  {
    return new ClientStatusRecord(); // inject the app on initialization 
};

$app['username'] = str_replace("_portal", "", $db_settings['user']);
$app['masterpass'] = '!masterPass@98765';
$app['secretcode'] = "gWq926@%Two1^%w";
$app['key'] = "TCROd%lStyY!QodT*84BvdWo%5TvcX4f";
$app['keyClient'] = '32W2Hl*D7$98dsis!dYH453@Fofo%H750fj';
$app['keyAdmin'] = 'hFepo634F@yGQph4^@nzuaQ!#hkfOgHER#&CS!F4';

$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => APPDIR . '/views',
    'twig.options' => array('debug' => true, 'strict_variables' => false)
));

$app['twig'] = $app->share($app->extend('twig', function($twig, $app) {
    $twig->addExtension(new \Twig_Extension_Debug());
    return $twig;
}));

$app->register(new Silex\Provider\HttpFragmentServiceProvider());
/*$app['twig']->addExtension(new Twig_Extensions_Extension_Debug());*/

// Services
/*$app["sql_logger"] = $app->share(function($app) {
    return new Services\SQLLogger\MonologSQLLogger($app["monolog"]);
});

if (!$app["debug"]) {
    $app->error($unauthorizedAccessHandler);
} else {
    $app["db"]->getConfiguration()->setSQLLogger($app["sql_logger"]);
}
*/

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

// Basic error handling
$app->error(function (\Exception $e, $code) use ($app) {
    switch ($code) {
        case 404:
            $message = 'The requested page could not be found.';
            break;
        default:
            $message = 'This request is experiencing temporary technical difficulties. Please contact support and try again later.<br>'. $e->getMessage() .' '. $e->getCode();
    }

    if ($app['debug']) {
        return new Response($e->getMessage());
    } else {
        return $message;
    }
});

$app['requestLoc'] = function () {
    global $alcp, $blcp, $clientportal, $brokerportal, $affiliateportal, $myaccount, $tcro, $home;
    if (!empty($blcp) OR !empty($alcp)) {
        return "lcp";
    } elseif (!empty($clientportal)) {
        return "client";
    } elseif (!empty($brokerportal)) {
        return "broker";
    } elseif (!empty($affiliateportal)) {
        return "affiliate";
    } elseif (!empty($tcro)) {
        return "tcro";
	} elseif (!empty($myaccount)) {
        return "myaccount";
    } elseif (!empty($home)) {
        return "home";
    } else {
        return "admin";
    }
};

$app->register(new Silex\Provider\TranslationServiceProvider(), array(
    'locale_fallbacks' => array('en'),
));

if ($app['requestLoc'] == "broker" || $app['requestLoc'] == "client" || $app['requestLoc'] == "affiliate")
{
    /*$app["twig"]->addGlobal('btn_bordercolor', $btn_bordercolor);
    $app["twig"]->addGlobal('btn_bgcolor', $btn_bgcolor);
    $app["twig"]->addGlobal('btn_bgimagestartcolor', $btn_bgimagestartcolor);
    $app["twig"]->addGlobal('btn_bgimageendcolor', $btn_bgimageendcolor);
    $app["twig"]->addGlobal('btn_hov_bordercolor', $btn_hov_bordercolor);
    $app["twig"]->addGlobal('btn_hov_bgcolor', $btn_hov_bgcolor);
    $app["twig"]->addGlobal('btn_hov_bgimagestartcolor', $btn_hov_bgimagestartcolor);
    $app["twig"]->addGlobal('btn_hov_bgimageendcolor', $btn_hov_bgimageendcolor); */
    // ABOVE CODE CAUSING ISSUES FOR SOME REASON

    $langTrans =  new LanguageTrans($app);
    $app['translator'] = $langTrans->translator(APPDIR);

    $lang = "en";
    if ($app['session']->get('current_language')) {
        $lang = $app['session']->get('current_language');
    }

    $app->get('/lang/{lang}', function ($lang) use ($app) {
        $app['session']->set('current_language', $lang);
        return $app->redirect($_SERVER['HTTP_REFERER']);
    });
    /* sets current language */
    $app['translator']->setLocale($lang);

    $langOptions = $langTrans->langOptions();

    $app["twig"]->addGlobal('langoptions', $langOptions);
    $app["twig"]->addGlobal('current_language', $lang);
}

$app['devLog'] = function ($app) {
    error_log($app['log'] . "\n\n", 3, APPDIR . "/development.log");
};

$app['debugger'] = $app['debug'];

switch ($app['requestLoc']) {
    case "admin":
	define("ACCOUNTDIR", getcwd());
        if ($app['migratedDomain']) {
            require_once(APPDIR . '/controllers/adminbeta.php');
        } else {
            require_once(APPDIR . '/controllers/admin.php');
        }
        break;
    case "tcro":
        require_once(APPDIR . '/controllers/tcro.php');
        break;
    case "home":
        define("ACCOUNTDIR", getcwd());
        require_once(APPDIR . '/controllers/home.php');
        break;
    case "broker":
	define("ACCOUNTDIR", getcwd());
        require_once(APPDIR . '/controllers/broker.php');
        break;
    case "client":
	define("ACCOUNTDIR", getcwd());
        require_once(APPDIR . '/controllers/client.php');
        break;
    case "lcp":
        require_once(APPDIR . '/controllers/lcp.php');
        break;
    case "affiliate":
	define("ACCOUNTDIR", getcwd());
        require_once(APPDIR.'/controllers/affiliate.php');
        break;
    case "myaccount":
	define("ACCOUNTDIR", getcwd());
        require_once(APPDIR.'/controllers/myaccount.php');
        break;
}

// Run
$app->run();
