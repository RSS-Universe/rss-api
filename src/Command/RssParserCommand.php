<?php

namespace App\Command;

use App\Model\Entity\DomainFeed;
use App\Model\Table\DomainFeedsTable;
use App\Service\FeedParserService;
use Cake\Console\Arguments;
use Cake\Console\Command;
use Cake\Console\ConsoleIo;
use Cake\Console\ConsoleOptionParser;
use Cake\Datasource\ResultSetInterface;
use FeedException;

/**
 * RssParser command.
 *
 * @property DomainFeedsTable $DomainFeeds
 */
class RssParserCommand extends Command
{

    public function initialize()
    {
        parent::initialize();
        $this->loadModel('DomainFeeds');
    }

    /**
     * Hook method for defining this command's option parser.
     *
     * @see https://book.cakephp.org/3.0/en/console-and-shells/commands.html#defining-arguments-and-options
     *
     * @param ConsoleOptionParser $parser The parser to be defined
     * @return ConsoleOptionParser The built parser.
     */
    public function buildOptionParser(ConsoleOptionParser $parser): ConsoleOptionParser
    {
        $parser = parent::buildOptionParser($parser);

        return $parser;
    }

    /**
     * Implement this method with your command's logic.
     *
     * @param Arguments $args The command arguments.
     * @param ConsoleIo $io The console io
     * @return null|int The exit code or null for success
     * @throws FeedException
     */
    public function execute(Arguments $args, ConsoleIo $io)
    {
        $feeds = $this->fetchFeeds();
        foreach ($feeds as $feed) {
            $io->info('fetching feed: ' . $feed->name);
            $entities = FeedParserService::getInstance()->parse($feed);
            if (count($entities) === 0) {
                $io->info('No new feed items found.');
            } else {
                foreach ($entities as $entity) {
                    $io->info("\t Added: " . $entity->title);
                }
                $io->info('complete!');
            }

            $io->hr();
        }
    }

    /**
     * @return ResultSetInterface|DomainFeed[]
     */
    protected function fetchFeeds()
    {
        return $this->DomainFeeds->find()
            ->whereNull(['last_fetch'])->all();
    }
}
