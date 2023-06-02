<?php

namespace Snaptec\CustomCommand\Console\Command;

use Exception;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use Magento\CatalogInventory\Api\StockRegistryInterface;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\App\Area;
use Magento\Framework\App\State;

/**
 * Class SomeCommand
 */
class SomeCommand extends Command
{
    const NAME = 'name';

    private $stockRegistry;

    private $producRepository;

    private $productCollection;

    private $area;

    private $state;

    public function __construct(
        StockRegistryInterface $stockRegistry,
        CollectionFactory $productCollection
    ) {
        $this->stockRegistry = $stockRegistry;
        $this->productCollection = $productCollection;
       



        parent::__construct();
    }



    /**
     * @inheritDoc
     */
    protected function configure()
    {
        $this->setName('snaptec:updatestock');
        $this->setDescription('This is my first console command.');
        

        parent::configure();
    }

    /**
     * Execute the command
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     *
     * @return null|int
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {


        // if ($name = $input->getOption(self::NAME)) {
        //     $output->writeln('<info>Provided name is `' . $name . '`</info>');
        // }

        // try {
        //     $productList[] = $this->productCollection->create();
        //     $quantity = 1000;
        //     foreach ($productList as $product) {
        //         $productId = $product->getId();
        //         $stockItem = $this->stockRegistry->getStockItem($productId);
        //         $stockItem->setQty($quantity);
        //         $stockItem->setIsInStock((bool)($quantity>0));
        //         $this->stockRegistry->updateStockItemBySku($product->getSku(),$stockItem);
        //     }
        //     $output->writeln('<info>Success Message.</info>');
        //     return 0;
        // } catch (Exception $e) {
        //     $output->writeln('<error> An error encountered' . $e->getMessage() . '.</error>');
        //     $output->writeln('<comment>Some Comment.</comment>');
        //     return 1;
        // }
        
         $output->setDecorated(true);
         $productList = $this->productCollection->create();
         try {
             foreach ($productList as $product) {
                 $productId = $product->getId();
                 $newQty = 1001;
                 $stockRegistry = $this->stockRegistry;
                 $stockItem = $stockRegistry->getStockItem($productId);
                 $stockItem->setQty($newQty);
                 $stockItem->setIsInStock((bool)($newQty > 0));
                 $stockRegistry->updateStockItemBySku($product->getSku(), $stockItem);
             }
             $output->writeln("<info>Updated qty stock successfully</info>");
             return \Magento\Framework\Console\Cli::RETURN_SUCCESS;
         } catch (\Exception $exception) {
             $output->writeln("<error>{$exception->getMessage()}</error>");
         
             return \Magento\Framework\Console\Cli::RETURN_FAILURE;
         }
    }
}
