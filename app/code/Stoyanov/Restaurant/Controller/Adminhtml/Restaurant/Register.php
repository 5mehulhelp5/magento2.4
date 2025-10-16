<?php
declare(strict_types=1);

namespace Stoyanov\Restaurant\Controller\Adminhtml\Restaurant;

use Magento\Backend\App\Action;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\View\Result\Page;

class Register extends Action implements HttpGetActionInterface
{
    public const string ADMIN_RESOURCE = 'Stoyanov_Restaurant::restaurant_user';

    /**
     * @param Action\Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        protected Action\Context $context,
        protected PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
    }

    /**
     * Register form page
     *
     * @return Page
     */
    public function execute(): Page
    {
        $page = $this->resultPageFactory->create();
        $page->setActiveMenu('Stoyanov_Restaurant::restaurant');
        $page->getConfig()->getTitle()->prepend(__('New profile'));
        return $page;
    }
}
