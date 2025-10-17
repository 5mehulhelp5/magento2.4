<?php

declare(strict_types=1);

namespace Stoyanov\Restaurant\Controller\Restaurant;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\View\Result\Page;
use Magento\Backend\Model\View\Result\ForwardFactory;
use Stoyanov\Restaurant\Api\RestaurantManagerInterface;

class Delete extends Action
{
    /**
     * @param Context $context
     * @param PageFactory $pageFactory
     * @param RestaurantManagerInterface $manager
     * @param ForwardFactory $forward
     */
    public function __construct(
        Context $context,
        private PageFactory $pageFactory,
        private RestaurantManagerInterface $manager,
        private ForwardFactory $forward
    ) {
        parent::__construct($context);
    }

    /**
     * Delete Restaurant Action
     *
     * @return Page
     */
    public function execute(): Page
    {
        if ($this->_request->isPost()) {
            $forwardResult = $this->forward->create();
            if ($this->manager->deleteRestaurant((int) $this->_request->getParams()["id"])) {
                $forwardResult->forward('index');
            }
            $this->messageManager->addSuccess(__('The restaurant is deleted!'));
        }
        return $this->pageFactory->create();
    }
}
