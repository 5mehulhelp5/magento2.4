<?php
declare(strict_types=1);

namespace Stoyanov\Restaurant\Controller\Adminhtml\Restaurant;

use Magento\Backend\App\Action;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Controller\Result\Redirect;
use Stoyanov\Restaurant\Api\RestaurantRepositoryInterface;

class Delete extends Action implements HttpPostActionInterface
{
    public const string ADMIN_RESOURCE = 'Stoyanov_Restaurant::restaurant_delete';

    /**
     * @param Action\Context $context
     * @param RestaurantRepositoryInterface $repository
     */
    public function __construct(
        protected Action\Context $context,
        private RestaurantRepositoryInterface $repository,
    ) {
        parent::__construct($context);
    }

    /**
     * Delete restaurant action
     *
     * @return Redirect
     */
    public function execute(): Redirect
    {
        $id = (int) $this->getRequest()->getParam('id');

        $resultRedirect = $this->resultRedirectFactory->create();
        if ($id) {
            try {
                $this->repository->deleteById($id);
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
