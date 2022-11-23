<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Tech9logy\Indexer\Controller\Indexer;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Indexer\Model\IndexerFactory;
use Magento\Indexer\Model\Indexer\CollectionFactory;
 
 
class Index extends Action
{
 
    /**
     * @var PageFactory
     */
    protected $_resultPageFactory;
	
	protected $indexFactory;
	
    protected $indexCollection;
 
 
 
    /**
     * View constructor.
     * @param Context $context
     * @param PageFactory $resultPageFactory
     * @param JsonFactory $resultJsonFactory
     */
    public function __construct(Context $context, PageFactory $resultPageFactory, IndexerFactory $indexFactory, CollectionFactory $indexCollection)
    {
 
        $this->_resultPageFactory = $resultPageFactory;
		$this->indexFactory = $indexFactory;
        $this->indexCollection = $indexCollection;
 
        parent::__construct($context);
    }
 
 
    /**
     * @return \Magento\Framework\Controller\Result\Json
     */
    public function execute()
    {
		
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
   
   echo "Done"; die;
 
}

}