<?php
declare(strict_types=1);

namespace Stoyanov\Restaurant\Controller\Adminhtml\Restaurant;

use Magento\{
    Backend\App\Action,
    Framework\App\Action\HttpGetActionInterface,
    Framework\Registry,
    Backend\Model\View\Result\ForwardFactory,
    Backend\Model\View\Result\Forward};
class NewAction extends Action implements HttpGetActionInterface
{
    public function __construct(
        protected Action\Context $context,
        protected ForwardFactory $resultForwardFactory,
        protected Registry $coreRegistry,
    ) {
        parent::__construct($context, $coreRegistry);
    }

    public function execute(): Forward
    {
        $resultForward = $this->resultForwardFactory->create();
        return $resultForward->forward('edit');
    }
}
