<?php
declare(strict_types=1);

namespace Stoyanov\Restaurant\Controller\Adminhtml\Restaurant;

use Magento\Backend\App\Action;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Registry;

class Save extends Action implements HttpGetActionInterface
{
    const ADMIN_RESOURCE = 'Stoyanov_Restaurant::restaurant_save';

    public function __construct(
        protected Action\Context $context,
        protected PageFactory $resultPageFactory,
        protected Registry $coreRegistry,
    ) {
        parent::__construct($context, $coreRegistry);
    }

    public function execute()
    {
      die("LLLOOOOWWW");
    }
}
