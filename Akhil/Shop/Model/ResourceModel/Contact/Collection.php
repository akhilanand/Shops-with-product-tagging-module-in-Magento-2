<?php
namespace Akhil\Shop\Model\ResourceModel\Contact;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'shop_id';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Akhil\Shop\Model\Contact', 'Akhil\Shop\Model\ResourceModel\Contact');
    }
}
