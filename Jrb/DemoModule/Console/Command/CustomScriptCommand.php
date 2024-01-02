<?php
/**
 * @Module         : Jrb Demomodule
 * @Package        : Jrb_Demomodule
 * @Description    : Testing custom script output
 * @Developer      : Jyotiranjan Biswal<biswal@jyotiranjan.in>
 * @Copyright      : https://www.jyotiranjan.in/
 */

 namespace Jrb\DemoModule\Console\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class CustomScriptCommand
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class CustomScriptCommand extends \Symfony\Component\Console\Command\Command
{
    /**
     * @var \Jrb\DemoModule\Model\CustomScript
     */
    protected $customScript;

    /**
     * @var \Magento\Framework\App\State
     */
    protected $appState;

    /**
     * @param \Jrb\DemoModule\Model\CustomScript $customScript
     * @param \Magento\Framework\App\State $appState
     */
    public function __construct(
        \Jrb\DemoModule\Model\CustomScript $customScript,
        \Magento\Framework\App\State $appState
    ) {
        $this->customScript = $customScript;
        $this->appState = $appState;
        parent::__construct();
    }

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this->setName('demomodule:run_customscript');
        $this->setDescription('execute demomodule custom script');
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->setDecorated(true);
        $this->appState->setAreaCode(\Magento\Framework\App\Area::AREA_GLOBAL);
        try {
            $this->customScript->execute();
            $output->writeln("customscript command executed");
            return \Magento\Framework\Console\Cli::RETURN_SUCCESS;
        } catch (\Exception $exception) {
            return \Magento\Framework\Console\Cli::RETURN_FAILURE;
        }
    }
}
 

