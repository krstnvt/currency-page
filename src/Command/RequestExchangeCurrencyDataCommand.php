<?php

namespace App\Command;

use App\Services\RequestCurrencyService;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:request-exchange-currency-data',
    description: 'Request exchange rates and store in the database',
)]
class RequestExchangeCurrencyDataCommand extends Command
{
    public function __construct(
        private RequestCurrencyService $currencyService,
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $this->currencyService->requestCurrencyData();

        $io->success('Exchange rates requested and stored successfully.');

        return Command::SUCCESS;
    }
}
