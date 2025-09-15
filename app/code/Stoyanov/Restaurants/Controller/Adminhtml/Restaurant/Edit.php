<?php
declare(strict_types=1);

namespace Stoyanov\Restaurants\Controller\Adminhtml\Restaurant;

use Magento\Backend\App\Action;
use Magento\Framework\View\Result\PageFactory;

class Edit extends Action
{
    const ADMIN_RESOURCE = 'Stoyanov_Restaurants::restaurants_edit';

    public function __construct(Action\Context $context, protected PageFactory $resultPageFactory)
    {
        parent::__construct($context);
    }

    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        return $resultPage;
    }
}
