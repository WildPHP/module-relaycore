<?php
/**
 * Copyright 2017 The WildPHP Team
 *
 * You should have received a copy of the MIT license with the project.
 * See the LICENSE file for more information.
 */

namespace WildPHP\Modules\RelayCore;

class MessageDistributor
{
	/**
	 * @param RelayGroup $group
	 * @param Message $message
	 */
	public function distributeMessage(RelayGroup $group, Message $message)
	{
		foreach ($group->getDrivers() as $driver)
		{
			var_dump($message->getSourceDriver()->getIdentifier(), $driver->getIdentifier());
			echo '---' . PHP_EOL;
			if ($message->getSourceDriver() === $driver)
				continue;

			// TODO Add file hosting stuff here...

			$driver->relayMessage($message);
		}
	}
}