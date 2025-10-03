<?php
declare(strict_types=1);

namespace Stoyanov\Restaurant\Controller\Adminhtml\Restaurant;

use Magento\Backend\App\Action;
use Magento\Framework\{App\Action\HttpPostActionInterface, Controller\Result\Redirect};

class Delete extends Action implements HttpPostActionInterface
{
    const ADMIN_RESOURCE = 'Stoyanov_Restaurant::restaurant_delete';

    public function execute(): Redirect
    {
        $id = $this->getRequest()->getParam('id');

        $resultRedirect = $this->resultRedirectFactory->create();
        if ($id) {
            $title = "";
            try {
                // init model and delete
                $model = $this->_objectManager->create(\Stoyanov\Restaurant\Model\Restaurant::class);
                $model->load($id);
                $model->delete();
                // display success message
                $this->messageManager->addSuccessMessage(__('The restaurant has been deleted.'));


                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                // display error message
                $this->messageManager->addErrorMessage($e->getMessage());
                // go back to edit form
                return $resultRedirect->setPath('*/*/edit', ['id' => $id]);
            }
        }

        // display error message
        $this->messageManager->addErrorMessage(__('We can\'t find a page to delete.'));

        return $resultRedirect->setPath('*/*/');
    }
}
