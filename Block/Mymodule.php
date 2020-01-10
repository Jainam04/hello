<?php
namespace Loadmore\Mymodule\Block;
class Mymodule extends \Magento\Framework\View\Element\Template
{
    protected $_productCollectionFactory;
        
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,        
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory,        
        array $data = []
    )
    {    
        $this->_productCollectionFactory = $productCollectionFactory;    
        parent::__construct($context, $data);
    }
    
    public function getProductCollection()
    {
        $collection = $this->_productCollectionFactory->create();
        $collection->addAttributeToSelect('*');
        //$collection->setPageSize(5); // fetching only 3 products
        $pager = $this->getLayout()->createBlock(
            'Magento\Theme\Block\Html\Pager'
        )->setAvailableLimit(array(5=>5,10=>10,15=>15))->setShowPerPage(true)->setCollection(
            $collection
        );
        $this->setChild('pager', $pager);
        return $collection;
    }

    public function getPagerHtml()
    {
    return $this->getChildHtml('pager');
    }
}
?>