<?php

namespace App\Command;

use Cake\Console\Arguments;
use Cake\Console\Command;
use Cake\Console\ConsoleIo;
use Cake\Filesystem\Folder;

/**
 * CopyNpmAssets command.
 */
class CopyNpmAssetsCommand extends Command
{

    protected $asset_map = [
        'bootstrap/dist/' => 'bootstrap',
        'jquery/dist/' => 'jquery',
        'font-awesome/' => 'font-awesome'
    ];

    /**
     * @param Arguments $args console arguments
     * @param ConsoleIo $io console inputs
     * @return void
     */
    public function execute(Arguments $args, ConsoleIo $io)
    {
        $folder = new Folder('./');

        foreach ($this->asset_map as $from => $to) {
            $source = ROOT . DS . 'vendor' . DS . 'npm-asset/' . $from;
            $target = WWW_ROOT . 'assets/' . $to;
            $folder->copy([
                'from' => $source,
                'to' => $target,
                'mode' => 0755,
                'scheme' => Folder::MERGE,
            ]);
        }
    }
}
