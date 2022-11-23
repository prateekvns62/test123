<?php


namespace Tech9logy\Customcat\Plugin;

class Toolbar
{

  protected $_objectManager;
	protected $request;

  public function __construct(
    \Magento\Framework\ObjectManagerInterface $objectmanager,
    \Magento\Framework\App\Request\Http $request
  ) {
    $this->_objectManager = $objectmanager;
    $this->request = $request;
  }

 public function aroundSetCollection(
    \Magento\Catalog\Block\Product\ProductList\Toolbar $subject,
    \Closure $proceed,
    $request
  ) {
     $result = $proceed($request);

    $this->_collection = $request;
      $productCollection = $this->_collection->setPageSize(10)->getData();  	 
    return $result;
  }

}
