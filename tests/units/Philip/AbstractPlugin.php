<?php
namespace tests\units\Twitchirc;

use atoum;

require_once __DIR__ . '/../bootstrap.php';

class AbstractPlugin extends atoum
{
    public function test__construct()
    {
        $this
            ->if($bot = new \Twitchirc\Twitchirc())
            ->then
                ->object($object = new \mock\Twitchirc\AbstractPlugin($bot))->isInstanceOf('\\Twitchirc\\AbstractPlugin')
                ->object($object->getBot())->isIdenticalTo($bot)
                ->array($object->getConfig())->isEqualTo(array())
        ;
    }

    public function testGetEmptyConfig()
    {
        $this
            ->if($bot = new \Twitchirc\Twitchirc())
            ->and($object = new \mock\Twitchirc\AbstractPlugin($bot))
            ->then
                ->array($object->getConfig())->isEqualTo(array())
        ;
    }

    public function testGetConfig()
    {
        $this
            ->if($bot = new \Twitchirc\Twitchirc())
            ->if($config = array(uniqid() => uniqid()))
            ->and($object = new \mock\Twitchirc\AbstractPlugin($bot, $config))
            ->then
            ->array($object->getConfig())->isEqualTo($config)
        ;
    }
}
