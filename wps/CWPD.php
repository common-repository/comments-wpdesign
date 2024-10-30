<?php
/**
 * @package  CommentswpDesign
 * @developer  name : Abu Sayed Russell
 */
namespace CWPD;

final class CWPD
{
	/**
	 * Store all the classes inside an array
	 * @return array Full list of classes
	 * Feature added by : Abu Sayed Russell abusayedrussell@gmail.com
 	 * Date       : 06.04.2020
	 */
	public static function cwpd_getServices()
	{
		return [
			Common\CWPDAdminController::class,
			Common\CWPDFrontController::class,
			Common\CWPDAjaxController::class,
			Setup\CWPDEnqueue::class,
		];
	}

	/**
	 * Loop through the classes, initialize them,
	 * and call the cwpd_registerServices() method if it exists
	 * @return
	 * Feature added by : Abu Sayed Russell abusayedrussell@gmail.com
 	 * Date       : 06.04.2020
	 */
	public static function cwpd_registerServices()
	{
		foreach (self::cwpd_getServices() as $class) {
			$cwpd_service = self::cwpd_instantiate($class);
			if (method_exists($cwpd_service, 'cwpd_register')) {
				$cwpd_service->cwpd_register();
			}
		}
	}

	/**
	 * Initialize the class
	 * @param  class $class    class from the services array
	 * @return class cwpd_instantiate  new instance of the class
	 * Feature added by : Abu Sayed Russell abusayedrussell@gmail.com
 	 * Date       : 06.04.2020
	 */
	private static function cwpd_instantiate($class)
	{
		$cwpd_service = new $class();

		return $cwpd_service;
	}
}