<?php

declare(strict_types=1);

namespace Stoyanov\Restaurant\Controller\Restaurant;
use Magento\{
    Framework\App\Action\Action,
    Framework\App\Action\Context,
    Framework\View\Result\PageFactory,
    Framework\View\Result\Page,
    Backend\Model\View\Result\ForwardFactory
};
use Stoyanov\Restaurant\{Api\RestaurantRepositoryInterface, Model\RestaurantFactory};

class Delete extends Action
{
    public function __construct(
        Context $context,
        private PageFactory $pageFactory,
        private RestaurantRepositoryInterface $repository,
        private RestaurantFactory $factory,
        private ForwardFactory $forward
    )
    {
        parent::__construct($context);
    }

    public function execute(): Page
    {
        if ($this->_request->isPost()) {
            $model = $this->factory->create();
            $restaurant = $model->load($this->_request->getParams()["id"]);
            $forwardResult = $this->forward->create();
            if ($this->repository->delete($restaurant)) $forwardResult->forward('index');
            $this->messageManager->addSuccess(__('The restaurant is deleted!'));
        }
        return $this->pageFactory->create();
    }
}
