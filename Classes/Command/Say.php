<?php
// Namespace
namespace Command;

/**
 * Sends the arguments to the channel, like say from a user.
 * arguments[0] == Channel or User to say message to.
 * arguments[1] == Message text.
 *
 * @package IRCBot
 * @subpackage Command
 * @author Daniel Siepmann <coding.layne@me.com>
 */
class Say extends \Library\IRC\Command\Base {
	/**
	 * The command's help text.
	 *
	 * @var string
	 */
	protected $help = 'Make the bot say something in a channel or to a user.';

	/**
	 * How to use the command.
	 *
	 * @var string
	 */
	protected $usage = 'say [#channel|username] whatever you want to say';
	
	/**
	 * Verify the user before executing this command.
	 *
	 * @var bool
	 */
	protected $verify = true;

	/**
	 * The number of arguments the command needs.
	 *
	 * @var integer
	 */
	protected $numberOfArguments = -1;

	/**
	 * Sends the arguments to the channel, like say from a user.
	 *
	 * IRC-Syntax: PRIVMSG [#channel]or[user] : [message]
	 */
	public function command() {

		if (!strlen($this->arguments[0]) OR !strlen($this->arguments[1]))
		{
			$this->say($this->usage);
			return;
		}

		$this->connection->sendData(
			'PRIVMSG ' . $this->arguments[0] .
			' :'. trim(implode( ' ', array_slice( $this->arguments, 1 ) ))
		);

	}
}
