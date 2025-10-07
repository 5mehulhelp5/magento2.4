<?php
declare(strict_types=1);

namespace Stoyanov\Restaurant\Controller\Adminhtml\Restaurant;

use Magento\Backend\App\Action;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\View\Result\Page;
use Magento\Framework\App\Action\HttpGetActionInterface;

class Edit extends Action implements HttpGetActionInterface
{
    public const string ADMIN_RESOURCE = 'Stoyanov_Restaurant::restaurant_save';

    /**
     * @param Action\Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        protected Action\Context $context,
        protected PageFactory $resultPageFactory,
    ) {
        parent::__construct($context);
    }

    /**
     * Edit restaurant action
     *
     * @return Page
     */
    public function execute(): Page
    {
        $page = $this->resultPageFactory->create();

        $page->setActiveMenu('Stoyanov_Restaurant::restaurant');
        $page->getConfig()->getTitle()->prepend(__('Edit Restaurant'));

        return $page;
    }
}
