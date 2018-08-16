<?php

if (!defined("ICETEA_INIT")) {
	define("ICETEA_INIT", 1);

	require __DIR__."/../config/init.php";

	if (!defined("BASEPATH")) {
		print "BASEPATH is not defined!\n";
		exit(1);
	}

	/**
	 * @param string $class
	 * @return void
	 */
	function iceteaInternalAutoloader(string $class): void
	{
		$class = str_replace("\\", "/", $class);
		if (file_exists($f = SRCPATH."/classes/".$class.".php")) {
			require $f;
			return;
		} else {
			if (substr($class, 0, 3) === "Phx") {
				if (file_exists($f = SRCPATH."/phx/".substr($class, 4).".phx")) {
					require $f;
					return;
				}
			}
		}
	}

	spl_autoload_register("iceteaInternalAutoloader");

	require SRCPATH."/helpers.php";
}
