<?php
/**
 * Created by PhpStorm.
 * User: twiener
 * Date: 12/13/14
 * Time: 3:51 PM
 */
namespace Wienerio\Burroughs;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Yaml\Yaml;
use Wienerio\Burroughs\Data\PayoutData;
use Wienerio\Burroughs\Writer\CsvWriter;

class ProcessorCommand extends Command
{
    protected $config;

    /**
     * Configure Console Comand
     */
    protected function configure()
    {
        $this
            ->setName('payout:generate')
            ->setDescription('Generation of a payout plan')
            ->addArgument(
                'filename',
                InputArgument::REQUIRED,
                'Specify an output filename!'
            );
    }

    /**
     * Executes command
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     *
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        //initialize config and file paths, csv writer
        $filename   = $input->getArgument('filename');
        $csvWriter  = new CsvWriter($filename);
        $parameters = Yaml::parse(__DIR__ . '/../../config/parameters.yml');
        $config     = $parameters['config'];

        $output->writeln('*****************************');
        $output->writeln('Payout Report Processor');
        $output->writeln('*****************************');
        $output->writeln(sprintf('Generating and Saving Payout Report to: <info>%s</info>', $filename));

        $processes = $this->getProcesses($parameters);

        //set start date and timezone
        $date = new \DateTime();
        $date->setTimezone(new \DateTimeZone($config['timezone']));

        $isFirstLine = true;
        for ($i = 0; $i < $config['month_count'] ; $i++) {
            $payoutDataItem = $this->getPayoutData($processes, $date);
            if ($isFirstLine) {
                $csvWriter->appendData($payoutDataItem->getHeaderAsArray());
            }
            $csvWriter->appendData($payoutDataItem->getDataAsArray());
            $isFirstLine = false;

            $date->modify('+1 month');
        }

        $output->writeln(sprintf('Total Processes: <info>%s</info>', count($processes)));
        $output->writeln(sprintf('Total Months processed: <info>%s</info>', $config['month_count']));
    }

    /**
     * Instantiates and returns processes given in config
     *
     * @param $parameters Parameters given in config
     *
     * @return array Array of processes
     */
    protected function getProcesses($parameters)
    {
        $processes = [];
        foreach ($parameters['processes'] as $process) {
            $class = $process['class'];
            //check if class implements Payout Interface
            $interfaces = class_implements($class);
            if (!isset($interfaces['Wienerio\Burroughs\PayoutProcessor\PayoutInterface'])) {
                continue;
            }

            $processes[] = new $class($process['config']);
        }

        return $processes;
    }

    /**
     * Return a PayoutData object (DTO) containing
     * the month and multiple payout calculation items as defined in the config file
     *
     * @param $processes Array of processes to be executed
     * @param $date The current datetime
     *
     * @return PayoutData The DTO Object containing the data
     */
    protected function getPayoutData($processes, $date)
    {
        $payoutData = new PayoutData();
        $payoutData->setDate($date->format('Y-m'));

        foreach ($processes as $process) {
            $currentDate = clone $date;
            $dateCalculated = $process->getPayoutDate($currentDate);
            $payoutData->addItem($process->getName(), $dateCalculated->format('Y-m-d'));
        }

        return $payoutData;
    }
}
