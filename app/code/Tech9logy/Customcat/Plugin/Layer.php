<?php


namespace Tech9logy\Customcat\Plugin;

class Layer
{

    public function aroundGetProductCollection(
        \Magento\Catalog\Model\Layer $subject,
    \Closure $proceed
  ) {
    
    $result = $proceed();
	$result->addAttributeToSort('product_view_order', 'ASC');
   
   
    return $result;
  }
}

