<?php
declare(strict_types=1);

namespace Stoyanov\Restaurant\Controller\Adminhtml\Restaurant;

use Magento\Backend\App\Action;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\Registry;

class Edit extends Action implements HttpGetActionInterface
{
    const ADMIN_RESOURCE = 'Stoyanov_Restaurant::restaurant_save';

    public function __construct(
        protected Action\Context $context,
        protected PageFactory $resultPageFactory,
        protected Registry $_coreRegistry
    ) {
        parent::__construct($context, $_coreRegistry);
    }

    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        $model = $this->_objectManager->create(\Stoyanov\Restaurant\Model\Restaurant::class);

        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                $this->messageManager->addErrorMessage(__('This restaurant no longer exists.'));
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/');
            }
        }

        $this->_coreRegistry->register('stoyanov_restaurant', $model);

        $resultPage = $this->_initAction();
        $resultPage->addBreadcrumb(
             __('Edit Restaurant'),
            __('Edit Restaurant')
        );
        $resultPage->getConfig()->getTitle()->prepend(__('Restaurants'));
        $resultPage->getConfig()->getTitle()
            ->prepend($model->getName());
        return $resultPage;
    }

    protected function _initAction()
    {
        // load layout, set active menu and breadcrumbs
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Stoyanov_Restaurant::restaurant_view')
            ->addBreadcrumb(__('Restaurant'), __('Restaurant'));
        return $resultPage;
    }
}
