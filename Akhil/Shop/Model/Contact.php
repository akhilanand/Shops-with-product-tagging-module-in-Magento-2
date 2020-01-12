<?php

namespace Akhil\Shop\Model;

use Magento\Framework\DataObject\IdentityInterface;

class Contact extends \Magento\Framework\Model\AbstractModel implements IdentityInterface
{

    /**
     * CMS page cache tag
     */
    const CACHE_TAG = 'akhil_products_grid';

    /**
     * @var string
     */
    protected $_cacheTag = 'akhil_products_grid';

    /**
     * Prefix of model events names
     *
     * @var string
     */
    protected $_eventPrefix = 'akhil_products_grid';

    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Akhil\Shop\Model\ResourceModel\Contact');
    }

    /**
     * Return unique ID(s) for each object in system
     *
     * @return array
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    public function getProducts(\Akhil\Shop\Model\Contact $object)
    {
        $tbl = $this->getResource()->getTable(\Akhil\Shop\Model\ResourceModel\Contact::TBL_ATT_PRODUCT);
        $select = $this->getResource()->getConnection()->select()->from(
            $tbl,
            ['product_id']
        )
        ->where(
            'shop_id = ?',
            (int)$object->getId()
        );
        return $this->getResource()->getConnection()->fetchCol($select);
    }


    public function getShopByProductId( $productId = null )
    {
        $tbl = $this->getResource()->getTable(\Akhil\Shop\Model\ResourceModel\Contact::TBL_ATT_PRODUCT);
        $select = $this->getResource()->getConnection()->select()->from(
            $tbl,
            ['shop_id']
        )
        ->where(
            'product_id = ?',
            (int)$productId
        );
        return $this->getResource()->getConnection()->fetchCol($select);
        
    }


    public function getShopById($shopId = null)
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();

        if($shopId){
            $shop = $objectManager->create('Akhil\Shop\Model\Contact')->load($shopId);
            return $shop;
        }

        return false;
    }


    public function getShops( $productId = null )
    {
        $data = array();
        if($productId){
            $shopIds = $this->getShopByProductId($productId);

            if(is_array($shopIds)){
                foreach ($shopIds as $shopId) {
                    $data[] = $this->getShopById($shopId);
                }
            }

        }
        return $data;
    }

}
