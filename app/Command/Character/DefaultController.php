<?php

declare(strict_types=1);

namespace App\Command\Character;

use Minicli\App;
use Minicli\Command\CommandController;

class DefaultController extends CommandController
{
    /** @var  array */
    protected $command_map = [];

    public function boot(App $app)
    {
        parent::boot($app);
        $this->command_map = $app->command_registry->getCommandMap();
    }

    public function handle()
    {
        $this->getPrinter()->info('Available Commands for Character');
        $this->getPrinter()->newline();
        $this->getPrinter()->out('- addquote quote="example_quote" id="character_id"');
        $this->getPrinter()->newline();
        $this->getPrinter()->out('- create name="character_name"');
        $this->getPrinter()->newline();
        $this->getPrinter()->out('- delete');
        $this->getPrinter()->newline();
        $this->getPrinter()->out('- retrieve');
        $this->getPrinter()->newline();
        $this->getPrinter()->info('You can use --help in all commands for more information');
    }
}
