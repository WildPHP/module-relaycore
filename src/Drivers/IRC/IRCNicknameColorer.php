<?php
/**
 * Copyright 2017 The WildPHP Team
 *
 * You should have received a copy of the MIT license with the project.
 * See the LICENSE file for more information.
 */

namespace WildPHP\Modules\RelayCore\Drivers\IRC;


use WildPHP\Core\Connection\TextFormatter;

class IRCNicknameColorer
{
	/**
	 * @param string $nickname
	 *
	 * @return string
	 */
	public static function colorNickname(string $nickname)
	{
		return TextFormatter::consistentStringColor($nickname);
	}
}