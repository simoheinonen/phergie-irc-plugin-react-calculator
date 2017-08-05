<?php

namespace Phergie\Irc\Plugin\React\Calculator;

use Phergie\Irc\Bot\React\AbstractPlugin;
use Phergie\Irc\Bot\React\EventQueue;
use Phergie\Irc\Event\Event;
use Phergie\Irc\Event\UserEvent;
use ChrisKonnertz\StringCalc\StringCalc;

class Plugin extends AbstractPlugin
{
    private $calculator;

    public function __construct(StringCalc $calculator)
    {
        $this->calculator = $calculator;
    }

    public function getSubscribedEvents()
    {
        return ['command.laske' => 'calculate'];
    }

    public function calculate(Event $event, EventQueue $queue)
    {
        try {
            $msg = $this->calculator->calculate(implode(' ', $event->getCustomParams())) . ' '; //  space because there's something wrong with sending only "0" as a message
        } catch (\Exception $ex) {
            $msg = 'Error';
        }

        $channel = $event->getSource();
        $queue->ircPrivmsg($channel, $msg);
    }
}
