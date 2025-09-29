<?php
declare(strict_types=1);

namespace Stoyanov\Restaurant\Controller\Adminhtml\Restaurant;

use Magento\Backend\App\Action;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\View\Result\Page;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\Registry;
use Stoyanov\Restaurant\Controller\Adminhtml\Restaurant;

class Edit extends Restaurant implements HttpGetActionInterface
{
    public function __construct(
        protected Action\Context $context,
        protected PageFactory $resultPageFactory,
        protected Registry $_coreRegistry
    ) {
        parent::__construct($context, $_coreRegistry);
    }

    public function execute(): Page
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

        // 5. Build edit form
        $resultPage = $this->resultPageFactory->create();
        $this->initPage($resultPage)->addBreadcrumb(
            $id ? __('Edit Restaurant') : __('New Restaurant'),
            $id ? __('Edit Restaurant') : __('New Restaurant')
        );

        $resultPage->getConfig()->getTitle()->prepend(__('Restaurants'));
        $resultPage->getConfig()->getTitle()->prepend($model->getId() ? $model->getName() : __('New Restaurant'));

        return $resultPage;
    }
}
