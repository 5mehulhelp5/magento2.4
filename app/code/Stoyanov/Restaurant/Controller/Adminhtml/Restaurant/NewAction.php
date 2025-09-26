<?php
declare(strict_types=1);

namespace Stoyanov\Restaurant\Controller\Adminhtml\Restaurant;

use Magento\Backend\App\Action;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\Registry;
use Magento\Backend\Model\View\Result\ForwardFactory;
use Stoyanov\Restaurant\Controller\Adminhtml\Restaurant;

class NewAction extends Restaurant implements HttpGetActionInterface
{
    public function __construct(
        protected Action\Context $context,
        protected ForwardFactory $resultForwardFactory,
        protected Registry $coreRegistry,
    ) {
        parent::__construct($context, $coreRegistry);
    }

    public function execute()
    {
        $resultForward = $this->resultForwardFactory->create();
        return $resultForward->forward('edit');
    }
}
