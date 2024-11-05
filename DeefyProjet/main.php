<?php
declare(strict_types=1);
require_once 'vendor/autoload.php';

session_start();


use \deefyprojet\render as RD;
use \deefyprojet\audio\tracks as AD;
use \deefyprojet\audio\lists as AL;
use \deefyprojet\action as ACT;
use \deefyprojet\dispatch as D;

\deefyprojet\repository\DeefyRepository::setConfig('db.config.ini'); //attention fichier à cacher et à déplacer

$repo = \deefyprojet\repository\DeefyRepository::getInstance();


$d = new D\Dispatcher();
$d->run();

