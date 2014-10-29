<?php

function createApplication()
{
	$unitTesting = true;

	$testEnvironment = 'testing';

	$app = require __DIR__ . '/../../../../bootstrap/start.php';

	$workbench = 'app/api';
	$segments = explode("/", $workbench);
	$vendor = studly_case($segments[0]);
	$package = studly_case($segments[1]);
	$namespace = "$vendor\\$package";
	$workbenchBase = base_path()."/workbench/$workbench";
	$workbenchService = "$namespace\\${package}ServiceProvider";

	// Fireup the workbench
	$app->register("$workbenchService");
	if (file_exists("$workbenchBase/src/views/")) {
		\View::addNamespace("$package", "$workbenchBase/src/views/");
	}
	return $app;
}
