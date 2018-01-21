<?php
/**
 * Created by PhpStorm.
 * User: rkerkhof
 * Date: 21-1-18
 * Time: 15:06
 */

namespace WildPHP\Modules\RelayCore;

/**
 * Class RelayGroup
 * @package WildPHP\Modules\RelayCore
 *
 * The purpose of this class is to group drivers together
 * within which messages will be distributed.
 */
class RelayGroup
{
	/** @var DriverInterface[] */
	protected $drivers = [];

	/**
	 * @param DriverInterface $driver
	 */
	public function addDriver(DriverInterface $driver)
	{
		if (in_array($driver, $this->drivers))
			throw new \InvalidArgumentException('RelayGroup already includes this driver.');

		$this->drivers[] = $driver;
	}

	/**
	 * @param DriverInterface $driver
	 */
	public function removeDriver(DriverInterface $driver)
	{
		if (!in_array($driver, $this->drivers))
			throw new \InvalidArgumentException('RelayGroup does not include this driver.');

		unset($this->drivers[array_search($driver, $this->drivers)]);
	}

	/**
	 * @return DriverInterface[]
	 */
	public function getDrivers()
	{
		return $this->drivers;
	}
}