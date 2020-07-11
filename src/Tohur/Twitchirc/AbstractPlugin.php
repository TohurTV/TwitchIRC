<?php

namespace Tohur\Twitchirc;

use Tohur\Twitchirc\IRC\Event;


abstract class AbstractPlugin
{
    /** @var \Tohur\Twitchirc\Twitchirc */
    protected $bot;

    /** @var array */
    protected $config = array();

    /**
     * Constructor
     *
     * @param \Tohur\Twitchirc\Twitchirc $bot
     * @param array $config Any plugin-specific configuration
     */
    public function __construct(Twitchirc $bot, array $config = array())
    {
        $this->bot = $bot;
        $this->config = $config;
    }

    /**
     * Returns a string name version of the plugin.
     *
     * @return string The name of the plugin
     */
    abstract public function getName();

    /**
     * Init the plugin and start listening to messages.
     */
    abstract public function init();

    /**
     * Returns a help message for the plugin.
     *
     * @param Event $event
     *
     * @return string A simple help message.
     */
    public function displayHelp(Event $event)
    {
        // By default, don't print a help message
    }

    /**
     * @return \Tohur\Twitchirc\Twitchirc
     */
    public function getBot()
    {
        return $this->bot;
    }

    /**
     * @return array
     */
    public function getConfig()
    {
        return $this->config;
    }
}
