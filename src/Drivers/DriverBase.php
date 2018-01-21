<?php
/**
 * Copyright 2017 The WildPHP Team
 *
 * You should have received a copy of the MIT license with the project.
 * See the LICENSE file for more information.
 */

namespace WildPHP\Modules\RelayCore\Drivers;


use WildPHP\Core\ComponentContainer;
use WildPHP\Modules\RelayCore\DriverInterface;
use WildPHP\Modules\RelayCore\Message;
use WildPHP\Modules\RelayCore\MessageDistributor;
use WildPHP\Modules\RelayCore\RelayCore;
use WildPHP\Modules\RelayCore\RelayGroup;

abstract class DriverBase implements DriverInterface
{
	/**
	 * @var ComponentContainer
	 */
	protected $container;
	/**
	 * @var string
	 */
	protected $identifier;
	/**
	 * @var RelayGroup
	 */
	protected $group;
	/**
	 * @var RelayCore
	 */
	protected $core;
	protected $messageDistributor;

	/**
	 * IRCRelayDriver constructor.
	 *
	 * @param string $identifier
	 * @param RelayGroup $group
	 * @param MessageDistributor $distributor
	 * @param ComponentContainer $container
	 */
	public function __construct(string $identifier, RelayGroup $group, MessageDistributor $distributor, ComponentContainer $container)
	{
		$this->container = $container;
		$this->identifier = $identifier;
		$this->group = $group;
		$this->messageDistributor = $distributor;
	}

	/**
	 * @param Message $message
	 *
	 * @return bool
	 */
	public function distributeMessage(Message $message): bool
	{
		$distributor = $this->messageDistributor;

		$distributor->distributeMessage($this->group, $message);
		return true;
	}
}