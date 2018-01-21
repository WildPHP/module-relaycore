<?php
/**
 * Copyright 2017 The WildPHP Team
 *
 * You should have received a copy of the MIT license with the project.
 * See the LICENSE file for more information.
 */

namespace WildPHP\Modules\RelayCore;


use WildPHP\Core\ComponentContainer;

interface DriverInterface
{
	/**
	 * DriverInterface constructor.
	 *
	 * @param string $identifier
	 * @param RelayGroup $group
	 * @param MessageDistributor $distributor
	 * @param ComponentContainer $container
	 */
	public function __construct(string $identifier, RelayGroup $group, MessageDistributor $distributor, ComponentContainer $container);

	/**
	 * Return a friendly prefix for use to distinguish between services.
	 * @return string
	 */
	public function getFriendlyPrefix(): string;

	/**
	 * @return string
	 */
	public function getFriendlyIdentifier(): string;

	/**
	 * @param Message $message
	 *
	 * @return bool True on success, false on failure.
	 */
	public function relayMessage(Message $message): bool;

	/**
	 * @param Message $message
	 *
	 * @return bool
	 */
	public function distributeMessage(Message $message): bool;

	/**
	 * Used to determine which file types can be uploaded to the destination.
	 *
	 * @return SupportedFileTypes
	 */
	public function getSupportedFileTypes(): SupportedFileTypes;

	/**
	 * @return string
	 */
	public function getIdentifier(): string;
}