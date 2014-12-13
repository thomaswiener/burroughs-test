<?php
$loader = require_once __DIR__ . "/./vendor/autoload.php";

use Symfony\Component\Console\Application;
use Wienerio\Burroughs\ProcessorCommand;

$console = new Application();
$console->add(new ProcessorCommand());
$console->run();