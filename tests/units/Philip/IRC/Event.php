<?php
namespace tests\units\Twitchirc\IRC;

use atoum;
use Twitchirc\IRC\Event as TestedClass;

require_once __DIR__ . '/../../bootstrap.php';

class Event extends atoum
{
    public function testConstruct()
    {
        $this
            ->if($this->mockGenerator->shuntParentClassCalls())
            ->and($request = new \mock\Twitchirc\IRC\Request($raw = uniqid()))
            ->then
                ->object($object = new TestedClass($request))->isInstanceOf('\\Twitchirc\\IRC\\Event')
                ->array($object->getMatches())->isEmpty()
                ->array($object->getResponses())->isEmpty()
        ;
    }

    public function testSetMatches()
    {
        $this
            ->if($this->mockGenerator->shuntParentClassCalls())
            ->and($request = new \mock\Twitchirc\IRC\Request($raw = uniqid()))
            ->and($object = new TestedClass($request))
            ->and($matches = array(uniqid(), uniqid()))
            ->then
                ->object($object->setMatches($matches))->isIdenticalTo($object)
                ->array($object->getMatches())->isEqualTo($matches)
        ;
    }

    public function testGetMatches()
    {
        $this
            ->if($this->mockGenerator->shuntParentClassCalls())
            ->and($request = new \mock\Twitchirc\IRC\Request($raw = uniqid()))
            ->and($object = new TestedClass($request))
            ->and($matches = array(uniqid(), uniqid()))
            ->then
                ->array($object->getMatches())->isEqualTo(array())
            ->if($object->setMatches($matches))
            ->then
                ->array($object->getMatches())->isEqualTo($matches)
        ;
    }

    public function testGetRequest()
    {
        $this
            ->if($this->mockGenerator->shuntParentClassCalls())
            ->and($request = new \mock\Twitchirc\IRC\Request($raw = uniqid()))
            ->and($object = new TestedClass($request))
            ->then
                ->object($object->getRequest())->isIdenticalTo($request)
        ;
    }

    public function testAddResponse()
    {
        $this
            ->if($this->mockGenerator->shuntParentClassCalls())
            ->and($request = new \mock\Twitchirc\IRC\Request($raw = uniqid()))
            ->and($response = new \Twitchirc\IRC\Response(uniqid()))
            ->and($object = new TestedClass($request))
            ->then
                ->object($object->addResponse($response))->isIdenticalTo($object)
                ->array($object->getResponses())->isEqualTo(array($response))
            ->if($otherResponse = new \Twitchirc\IRC\Response(uniqid()))
            ->and($object->addResponse($otherResponse))
            ->then
                ->array($object->getResponses())->isEqualTo(array($response, $otherResponse))
        ;
    }

    public function testGetResponses()
    {
        $this
            ->if($this->mockGenerator->shuntParentClassCalls())
            ->and($request = new \mock\Twitchirc\IRC\Request($raw = uniqid()))
            ->and($object = new TestedClass($request))
            ->and($matches = array(uniqid(), uniqid()))
            ->then
                ->array($object->getResponses())->isEmpty()
            ->if($response = new \Twitchirc\IRC\Response(uniqid()))
            ->and($object->addResponse($response))
            ->then
                ->array($object->getResponses())->isEqualTo(array($response))
            ->if($otherResponse = new \Twitchirc\IRC\Response(uniqid()))
            ->and($object->addResponse($otherResponse))
            ->then
                ->array($object->getResponses())->isEqualTo(array($response, $otherResponse))
        ;
    }
}
