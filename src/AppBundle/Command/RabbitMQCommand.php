<?php

namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use PhpAmqpLib\Connection\AMQPStreamConnection;

/**
 * Class RabbitMQCommand
 * @package AppBundle\Command
 */
class RabbitMQCommand extends ContainerAwareCommand {

    protected function configure() {
        $this->setName('rabbitmq:listen');
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        $output->writeln("start rabbitmQ listener");

        $connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
        $channel = $connection->channel();
        $channel->queue_declare('hello', false, false, false, false);
        $output->writeln("Nasłuchiwanie...");
        $callback = function($msg) use ($output) {
            $output->writeln("Odebrano " . $msg->body);
        };
        $channel->basic_consume('hello', '', false, true, false, false, $callback);
        while (count($channel->callbacks)) {
            $channel->wait();
        }
        $channel->close();
        $connection->close();
        $output->writeln("Koniec");
    }

}
