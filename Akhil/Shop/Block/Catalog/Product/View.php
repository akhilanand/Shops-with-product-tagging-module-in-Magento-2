<?php
namespace Akhil\Shop\Block\Catalog\Product;
 
use Magento\Catalog\Block\Product\Context;
use Magento\Catalog\Block\Product\AbstractProduct;
 
class View extends AbstractProduct
{

	protected $contact;


    protected $scopeConfig;

 
    public function __construct(
        \Magento\Catalog\Block\Product\Context $context,
        \Magento\Framework\Registry $registry,
        \Akhil\Shop\Model\Contact $contact,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        array $data = []
    ) 
    {
    	$this->contact 		= $contact;
    	$this->_registry 	= $registry;
        $this->scopeConfig = $scopeConfig;
        parent::__construct($context, $data);
    }

    public function getShops()
    {

    	$product 	= $this->getProduct();
    	$shops 		= $this->contact->getShops($product->getId());
    	return $shops;

    }


    public function isEnabled(){
        return $this->scopeConfig->getValue('shop/shop/enable', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

}