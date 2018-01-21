<?php
/**
 * Copyright 2017 The WildPHP Team
 *
 * You should have received a copy of the MIT license with the project.
 * See the LICENSE file for more information.
 */

namespace WildPHP\Modules\RelayCore\Drivers\IRC;


class IRCColorStripper
{
	// Source: http://www.aviran.org/stripremove-irc-client-control-characters/
	/**
	 * @param $text
	 *
	 * @return null|string|string[]
	 */
	public static function stripControlCharacters($text) {
		$controlCodes = array(
			'/(\x03(?:\d{1,2}(?:,\d{1,2})?)?)/',    // Color code
			'/\x02/',                               // Bold
			'/\x0F/',                               // Escaped
			'/\x16/',                               // Italic
			'/\x1F/'                                // Underline
		);
		return preg_replace($controlCodes,'',$text);
	}
}