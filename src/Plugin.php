<?php

namespace SimoHeinonen\Phergie\Plugin\Calculator;

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
        return ['command.calc' => 'calculate'];
    }

    public function calculate(Event $event, EventQueue $queue)
    {
        $string = str_replace(',', '.', implode(' ', $event->getCustomParams()));
        try {
            $msg = $this->calculator->calculate($string) . ' '; //  space because there's something wrong with sending only "0" as a message
        } catch (\Exception $ex) {
            $msg = 'Error';
        }

        $channel = $event->getSource();
        $queue->ircPrivmsg($channel, $msg);
    }
}
