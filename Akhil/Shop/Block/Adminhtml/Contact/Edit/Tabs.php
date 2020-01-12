<?php

namespace Akhil\Shop\Block\Adminhtml\Contact\Edit;

/**
 * Admin page left menu
 */
class Tabs extends \Magento\Backend\Block\Widget\Tabs
{
    /**
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('shop_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(__('Shop Information'));
    }
}
