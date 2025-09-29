<?php
declare(strict_types=1);

namespace Stoyanov\Restaurant\Controller\Adminhtml\Restaurant;

use Magento\Backend\App\Action;
use Magento\Framework\View\Result\{PageFactory, Page};
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\Registry;
use Stoyanov\Restaurant\Controller\Adminhtml\Restaurant;

class Index extends Restaurant implements HttpGetActionInterface
{
    const ADMIN_RESOURCE = 'Stoyanov_Restaurant::restaurant_view';

    public function __construct(
        Action\Context $context,
        protected PageFactory $resultPageFactory,
        protected Registry $coreRegistry,
    ) {
        parent::__construct($context, $coreRegistry);
    }

    public function execute(): Page
    {
        $resultPage = $this->resultPageFactory->create();
        $this->initPage($resultPage)->getConfig()->getTitle()->prepend(__('Restaurants'));

        $dataPersistor = $this->_objectManager->get(\Magento\Framework\App\Request\DataPersistorInterface::class);
        $dataPersistor->clear('stoyanov_restaurant');

        return $resultPage;
    }
}
