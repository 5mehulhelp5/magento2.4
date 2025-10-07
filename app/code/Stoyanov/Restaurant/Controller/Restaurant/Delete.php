<?php

declare(strict_types=1);

namespace Stoyanov\Restaurant\Controller\Restaurant;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\View\Result\Page;
use Magento\Backend\Model\View\Result\ForwardFactory;
use Stoyanov\Restaurant\Api\RestaurantRepositoryInterface;
use Stoyanov\Restaurant\Model\RestaurantFactory;

class Delete extends Action
{
    /**
     * @param Context $context
     * @param PageFactory $pageFactory
     * @param RestaurantRepositoryInterface $repository
     * @param RestaurantFactory $factory
     * @param ForwardFactory $forward
     */
    public function __construct(
        Context $context,
        private PageFactory $pageFactory,
        private RestaurantRepositoryInterface $repository,
        private RestaurantFactory $factory,
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
            if ($this->repository->deleteById((int) $this->_request->getParams()["id"])) {
                $forwardResult->forward('index');
            }
            $this->messageManager->addSuccess(__('The restaurant is deleted!'));
        }
        return $this->pageFactory->create();
    }
}
