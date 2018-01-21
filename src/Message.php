<?php
/**
 * Copyright 2017 The WildPHP Team
 *
 * You should have received a copy of the MIT license with the project.
 * See the LICENSE file for more information.
 */

/**
 * Created by PhpStorm.
 * User: rkerkhof
 * Date: 21-1-18
 * Time: 14:45
 */

namespace WildPHP\Modules\RelayCore;


class Message
{
	/** @var false|Message */
	protected $reply = false;

	/** @var MessageSender */
	protected $sender = null;

	/** @var string */
	protected $contents = '';

	/** @var DriverInterface */
	protected $source = null;

	/**
	 * Message constructor.
	 *
	 * @param DriverInterface $source
	 * @param MessageSender $sender
	 * @param string $contents
	 * @param false|Message $reply
	 */
	public function __construct(DriverInterface $source, MessageSender $sender, string $contents, $reply = false)
	{
		$this->source = $source;
		$this->reply = $reply;
		$this->sender = $sender;
		$this->contents = $contents;
	}

	/**
	 * @return DriverInterface
	 */
	public function getSourceDriver(): DriverInterface
	{
		return $this->source;
	}

	/**
	 * @return false|Message
	 */
	public function getReply()
	{
		return $this->reply;
	}

	/**
	 * @param false|Message $reply
	 */
	public function setReply($reply): void
	{
		$this->reply = $reply;
	}

	/**
	 * @return MessageSender
	 */
	public function getSender(): MessageSender
	{
		return $this->sender;
	}

	/**
	 * @param MessageSender $sender
	 */
	public function setSender(MessageSender $sender): void
	{
		$this->sender = $sender;
	}

	/**
	 * @return string
	 */
	public function getContents(): string
	{
		return $this->contents;
	}

	/**
	 * @param string $contents
	 */
	public function setContents(string $contents): void
	{
		$this->contents = $contents;
	}
}