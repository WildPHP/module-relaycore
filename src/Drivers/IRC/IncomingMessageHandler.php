<?php
/**
 * Copyright 2017 The WildPHP Team
 *
 * You should have received a copy of the MIT license with the project.
 * See the LICENSE file for more information.
 */

namespace WildPHP\Modules\RelayCore\Drivers\IRC;


use WildPHP\Core\ComponentContainer;
use WildPHP\Core\Connection\IRCMessages\PRIVMSG;
use WildPHP\Core\EventEmitter;
use WildPHP\Modules\RelayCore\Message;
use WildPHP\Modules\RelayCore\MessageDistributor;
use WildPHP\Modules\RelayCore\MessageSender;

class IncomingMessageHandler
{
	/** @var IRCRelayDriver */
	protected $driver;

	/** @var MessageDistributor */
	protected $distributor;

	/**
	 * IncomingMessageHandler constructor.
	 *
	 * @param IRCRelayDriver $driver
	 * @param ComponentContainer $container
	 *
	 * @throws \Yoshi2889\Container\ContainerException
	 * @throws \Yoshi2889\Container\NotFoundException
	 */
	public function __construct(IRCRelayDriver $driver, ComponentContainer $container)
	{
		EventEmitter::fromContainer($container)->on('irc.line.in.privmsg', [$this, 'handleIRCPrivmsg']);
		$this->driver = $driver;
	}

	/**
	 * @param PRIVMSG $privmsg
	 */
	public function handleIRCPrivmsg(PRIVMSG $privmsg)
	{
		if ($privmsg->getChannel() != $this->driver->getIdentifier())
			return;

		$sender = new MessageSender($privmsg->getNickname());
		$message = IRCColorStripper::stripControlCharacters($privmsg->getMessage());
		$message = new Message($this->driver, $sender, $message, false);

		$this->driver->distributeMessage($message);
	}
}