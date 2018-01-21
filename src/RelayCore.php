<?php
/**
 * Copyright 2017 The WildPHP Team
 *
 * You should have received a copy of the MIT license with the project.
 * See the LICENSE file for more information.
 */

namespace WildPHP\Modules\RelayCore;


use WildPHP\Core\ComponentContainer;
use WildPHP\Core\Configuration\Configuration;
use WildPHP\Core\Logger\Logger;
use WildPHP\Core\Modules\BaseModule;
use Yoshi2889\Container\ContainerException;
use Yoshi2889\Container\NotFoundException;

class RelayCore extends BaseModule
{

	/**
	 * RelayCore constructor.
	 *
	 * @param ComponentContainer $container
	 *
	 * @throws ContainerException
	 * @throws NotFoundException
	 */
	public function __construct(ComponentContainer $container)
	{
		$this->setContainer($container);
		$messageDistributor = new MessageDistributor();

		try
		{
			$config = Configuration::fromContainer($container)['relay'];

			if (empty($config['groups']) || empty($config['drivers']))
				throw new \Exception();

			$drivers = $config['drivers'];
			$groups = $config['groups'];

			foreach ($groups as $relayPairs)
			{
				$group = new RelayGroup();

				foreach ($relayPairs as $driver => $identifier)
				{
					$group->addDriver($this->instantiateDriver($drivers[$driver], $identifier, $group, $messageDistributor));
				}
			}

		}
		catch (\Exception $e)
		{
			Logger::fromContainer($container)->warning('Unable to initialize RelayCore due to missing or corrupt configuration. Message given: ' . $e->getMessage());
			return;
		}
	}

	/**
	 * @param string $class
	 *
	 * @param string $identifier
	 * @param RelayGroup $group
	 * @param MessageDistributor $distributor
	 *
	 * @return DriverInterface
	 * @throws ContainerException
	 * @throws NotFoundException
	 * @throws \Exception
	 * @throws \ReflectionException
	 */
	protected function instantiateDriver(string $class, string $identifier, RelayGroup $group, MessageDistributor $distributor): DriverInterface
	{
		if (!class_exists($class))
			throw new \Exception('The given class does not exist.');

		$reflection = new \ReflectionClass($class);

		if (!$reflection->implementsInterface(DriverInterface::class))
			throw new \Exception('The given class is not a (valid) relay driver!');

		try
		{
			$object = new $class($identifier, $group, $distributor, $this->getContainer());
		}
		catch (\Throwable $exception)
		{
			throw new \Exception('An exception occurred when initializing the relay driver: ' . $exception->getMessage(), 0, $exception);
		}

		Logger::fromContainer($this->getContainer())->debug('Initialized relay driver', [
			'class' => $class,
			'identifier' => $identifier
		]);

		return $object;
	}

	/**
	 * @return string
	 */
	public static function getSupportedVersionConstraint(): string
	{
		return '^3.0.0';
	}
}