<?php

namespace Akhil\Shop\Controller\Adminhtml\Contacts;

use Magento\Backend\App\Action;
use Magento\TestFramework\ErrorLog\Logger;

class Delete extends \Magento\Backend\App\Action
{
    /**
     * Delete action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('shop_id');
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($id) {
            try {
                $model = $this->_objectManager->create('Akhil\Shop\Model\Contact');
                $model->load($id);
                $model->delete();
                $this->messageManager->addSuccess(__('The shop has been deleted.'));
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                $this->messageManager->addError($e->getMessage());
                return $resultRedirect->setPath('*/*/edit', ['shop_id' => $id]);
            }
        }
        $this->messageManager->addError(__('We can\'t find a shop to delete.'));
        return $resultRedirect->setPath('*/*/');
    }
}
