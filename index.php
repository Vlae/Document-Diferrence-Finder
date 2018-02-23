<?php

require_once 'vendor/autoload.php';

use DocDiff\DifferenceFinder;

new DifferenceFinder('example1.txt', 'example2.txt', '/');
