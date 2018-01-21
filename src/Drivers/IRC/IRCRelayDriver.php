<?php
/**
 * Copyright 2017 The WildPHP Team
 *
 * You should have received a copy of the MIT license with the project.
 * See the LICENSE file for more information.
 */

namespace WildPHP\Modules\RelayCore\Drivers\IRC;

use WildPHP\Core\ComponentContainer;
use WildPHP\Core\Connection\Queue;
use WildPHP\Modules\RelayCore\Drivers\DriverBase;
use WildPHP\Modules\RelayCore\Message;
use WildPHP\Modules\RelayCore\MessageDistributor;
use WildPHP\Modules\RelayCore\RelayGroup;
use WildPHP\Modules\RelayCore\SupportedFileTypes;

class IRCRelayDriver extends DriverBase
{

	public function __construct(string $identifier, RelayGroup $group, MessageDistributor $distributor, ComponentContainer $container)
	{
		parent::__construct($identifier, $group, $distributor, $container);

		new IncomingMessageHandler($this, $container);
	}

	/**
	 * Return a friendly prefix for use to distinguish between services.
	 * @return string
	 */
	public function getFriendlyPrefix(): string
	{
		return 'IRC' . ':' . $this->getFriendlyIdentifier();
	}

	/**
	 * @param Message $message
	 *
	 * @return bool True on success, false on failure.
	 * @throws \Yoshi2889\Container\ContainerException
	 * @throws \Yoshi2889\Container\NotFoundException
	 */
	public function relayMessage(Message $message): bool
	{
		$string = '[%s] <%s> %s';

		$prefix = $message->getSourceDriver()->getFriendlyPrefix();
		$nickname = IRCNicknameColorer::colorNickname($message->getSender()->getNickname());
		$contents = $message->getContents();

		$string = sprintf($string, $prefix, $nickname, $contents);

		Queue::fromContainer($this->container)->privmsg($this->identifier, $string);
		return true;
	}

	/**
	 * Used to determine which file types can be uploaded to the destination.
	 *
	 * @return SupportedFileTypes
	 */
	public function getSupportedFileTypes(): SupportedFileTypes
	{
		// TODO: Implement getSupportedFileTypes() method.
	}

	/**
	 * @return string
	 */
	public function getIdentifier(): string
	{
		return $this->identifier;
	}

	/**
	 * @return string
	 */
	public function getFriendlyIdentifier(): string
	{
		return $this->identifier;
	}
}