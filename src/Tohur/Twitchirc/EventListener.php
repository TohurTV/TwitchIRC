<?php

namespace Tohur\Twitchirc;

use Symfony\Contracts\EventDispatcher\Event;

/**
 * A generic handler for all IRC events that pass through Twitchirc.
 *
 * Tests incoming messages against a pattern and if the message
 * matches the pattern, execute a given callback function.
 *
 * @author Joshua Webb <tohur@tohur.me>
 */
class EventListener
{
    /** @var string $pattern A RegEx to compare a string against */
    private $pattern;

    /** @var callable $callback A function to call */
    private $callback;

    /** @var array $matches Matches from testing the $pattern */
    private $matches;

    /**
     * Constructor.
     *
     * @param string   $pattern  A RegEx
     * @param callable $callback A callable
     */
    public function __construct($pattern, $callback)
    {
        $this->pattern = $pattern;
        $this->callback = $callback;
    }

    /**
     * Executes the given callback, returns the callback's return value.
     *
     * @param \Tohur\Twitchirc\IRC\Event $event The Twitchirc IRC event
     *
     * @return mixed
     */
    public function testAndExecute(Event $event)
    {
        if ($this->shouldExecuteCallback($event->getRequest()->getMessage())) {
            $event->setMatches($this->getMatches());

            return call_user_func($this->callback, $event);
        }

        return false;
    }

    /**
     * Tests the pattern against the given string.
     *
     * @param string $msg The string to test.
     *
     * @return boolean True if the pattern matched anything, false otherwise.
     */
    private function shouldExecuteCallback($msg)
    {
        if ($this->pattern) {
            return (bool) preg_match($this->pattern, $msg, $this->matches);
        }

        return true;
    }

    /**
     * Get the array of matches from the pattern.
     *
     * @return array The matches
     */
    private function getMatches()
    {
        if (count($this->matches)) {
            return array_slice($this->matches, 1);
        }

        return array();
    }
}
