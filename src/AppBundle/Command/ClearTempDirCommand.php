<?php

namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @author mathil <github.com/mathil>
 */
class ClearTempDirCommand extends ContainerAwareCommand
{

    /**
     * @param void
     */
    public function configure(): void
    {
        $this->setName('bm:clear:temp-dir');
        $this->setDescription("Clearing temporary files directory");
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $tempDir = $this->getContainer()->getParameter('temp_files_dir');

        if (false === file_exists($tempDir)) {
            $output->writeln(sprintf('Directory %dir does not exists.', $tempDir));
            return 1;
        }

        $files = scandir($tempDir);
        foreach ($files as $file) {
            if (in_array($file, ['.', '..'])) {
                continue;
            }
            unlink($tempDir . $file);
        }
        $output->writeln(sprintf('%d files deleted.', count($files) - 2));
        return 0;
    }

}
