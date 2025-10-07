<?php
declare(strict_types=1);

namespace Stoyanov\Restaurant\Controller\Adminhtml\Restaurant;

use Magento\Backend\App\Action;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\Registry;
use Magento\Backend\Model\View\Result\ForwardFactory;
use Magento\Backend\Model\View\Result\Forward;

class NewAction extends Action implements HttpGetActionInterface
{
    public const string ADMIN_RESOURCE = 'Stoyanov_Restaurant::restaurant_save';

    /**
     * @param Action\Context $context
     * @param ForwardFactory $resultForwardFactory
     * @param Registry $coreRegistry
     */
    public function __construct(
        protected Action\Context $context,
        protected ForwardFactory $resultForwardFactory,
        protected Registry $coreRegistry,
    ) {
        parent::__construct($context, $coreRegistry);
    }

    /**
     * New restaurant action
     *
     * @return Forward
     */
    public function execute(): Forward
    {
        $resultForward = $this->resultForwardFactory->create();
        return $resultForward->forward('edit');
    }
}
