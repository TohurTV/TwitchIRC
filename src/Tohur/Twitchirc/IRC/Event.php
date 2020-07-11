<?php

namespace Tohur\Twitchirc\IRC;

use Symfony\Contracts\EventDispatcher\Event as BaseEvent;

class Event extends BaseEvent
{
    /** @var \Tohur\Bot\Classes\Chat\IRC\Request $request The request object for this event */
    private $request;

    /** @var \Tohur\Bot\Classes\Chat\IRC\Response[] Array of responses for the event */
    private $responses = array();

    /** @var array $matches Array of matches for the pattern */
    private $matches = array();

    /**
     * Constructor.
     *
     * @param \Tohur\Twitchirc\IRC\Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Set the matches.
     *
     * @param array $matches
     */
    public function setMatches(array $matches)
    {
        $this->matches = $matches;

        return $this;
    }

    /**
     * Get the matches from the tested pattern.
     *
     * @return array
     */
    public function getMatches()
    {
        return $this->matches;
    }

    /**
     * Get the request.
     *
     * @return \Tohur\Twitchirc\IRC\Request
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * Add a response to the list of responses.
     *
     * @param string $response The IRC response
     */
    public function addResponse($response)
    {
        array_push($this->responses, $response);

        return $this;
    }

    /**
     * Get the responses.
     *
     * @return string[] All the responses to send
     */
    public function getResponses()
    {
        return $this->responses;
    }
}
