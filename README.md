# Relay core Module
[![Build Status](https://scrutinizer-ci.com/g/WildPHP/module-relaycore/badges/build.png?b=master)](https://scrutinizer-ci.com/g/WildPHP/module-relaycore/build-status/master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/WildPHP/module-relaycore/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/WildPHP/module-relaycore/?branch=master)
[![Latest Stable Version](https://poser.pugx.org/wildphp/module-relaycore/v/stable)](https://packagist.org/packages/wildphp/module-relaycore)
[![Latest Unstable Version](https://poser.pugx.org/wildphp/module-relaycore/v/unstable)](https://packagist.org/packages/wildphp/module-relaycore)
[![Total Downloads](https://poser.pugx.org/wildphp/module-relaycore/downloads)](https://packagist.org/packages/wildphp/module-relaycore)

Relay core module for WildPHP. This module includes IRC <-> IRC relay support.

## System Requirements
If your setup can run the main bot, it can run this module as well. For the file server, a system is needed with sufficient disk space to host a very small webserver (will grow over time).

## Installation
To install this module, we will use `composer`:

```composer require wildphp/module-relaycore```

That will install all required files for the module. In order to activate the module, add the following line to your modules array in `config.neon`:

    - WildPHP\Modules\RelayCore\RelayCore

The bot will run the module the next time it is started.

## Configuration
TODO

## Usage
TODO

## License
This module is licensed under the MIT license. Please see `LICENSE` to read it.
