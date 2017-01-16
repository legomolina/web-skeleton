<?php 

namespace MyApp\Utils;

class Utils {

	/**
     * Prints server Uri located in BASE_URL constant
     */

	public function getServerUri() {
		echo BASE_URL;
	}

	/**
     * Returns server Uri located in BASE_URL constant
     */

	public function returnServerUri() {
		return BASE_URL;
	}
}