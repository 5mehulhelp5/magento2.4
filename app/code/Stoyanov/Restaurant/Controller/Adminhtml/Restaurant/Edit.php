<?php
declare(strict_types=1);

namespace Stoyanov\Restaurant\Controller\Adminhtml\Restaurant;

use Magento\Backend\App\Action;
use Magento\Framework\{
    View\Result\PageFactory,
    View\Result\Page,
    App\Action\HttpGetActionInterface
};

class Edit extends Action implements HttpGetActionInterface
{
    const ADMIN_RESOURCE = 'Stoyanov_Restaurant::restaurant_save';

    public function __construct(
        protected Action\Context $context,
        protected PageFactory $resultPageFactory,
    )
    {
        parent::__construct($context);
    }

    public function execute(): Page
    {
        $page = $this->resultPageFactory->create();

        $page->setActiveMenu('Stoyanov_Restaurant::restaurant_view');
        $page->getConfig()->getTitle()->prepend(__('Edit Restaurant'));

        return $page;
    }
}
