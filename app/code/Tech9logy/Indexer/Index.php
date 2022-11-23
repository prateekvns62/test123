<?php
namespace Tech9logy\SmartSearch\Controller\Indexer;

class Index extends \Magento\Framework\App\Action\Action
{
 protected $indexFactory;
   protected $indexCollection;
 
   public function __construct(
    \Magento\Indexer\Model\IndexerFactory $indexFactory,
 \Magento\Indexer\Model\Indexer\CollectionFactory $indexCollection
   ){
        $this->indexFactory = $indexFactory;
        $this->indexCollection = $indexCollection;
 }
 
   public function execute()
   {
	   
	   echo "test"; die;
   $indexerCollection = $this->indexCollection->create();
   $indexids = $indexerCollection->getAllIds();
 
   foreach ($indexids as $indexid)
   {
     $indexidarray = $this->indexFactory->create()->load($indexid);
 
     //If you want reindex all use this code.
         $indexidarray->reindexAll($indexid);
 
     //If you want to reindex one by one, use this code
         $indexidarray->reindexRow($indexid);
   }
   }
}