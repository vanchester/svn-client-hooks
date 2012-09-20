#!/usr/bin/php
<?php
array_shift($argv);
$command = 'svn '.implode(' ', $argv);

if (!isset($argv[0])) {
	run($command);
	exit;
}

echo "searching pre-{$argv[0]}...";
$preHook = 'hooks'.DIRECTORY_SEPARATOR.'pre-'.$argv[0];
if (file_exists($preHook)) {
	echo "\n";
	run($preHook);
} else {
	echo " not found :(\n";
}

run($command);

echo "searching post-{$argv[0]}...";
$postHook = 'hooks'.DIRECTORY_SEPARATOR.'post-'.$argv[0];
if (file_exists($postHook)) {
	echo "\n";
        run($postHook);
} else {
	echo " not found :(\n";
}

function run($command) {
	//echo "executing command {$command}\n";
        passthru($command);
}
