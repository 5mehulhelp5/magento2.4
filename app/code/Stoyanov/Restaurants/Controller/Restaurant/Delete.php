<?php

declare(strict_types=1);

namespace Stoyanov\Restaurants\Controller\Restaurant;

use Magento\Framework\App\Action\{Action, Context};
use Magento\Framework\View\Result\PageFactory;
use \Stoyanov\Restaurants\Api\RestaurantRepositoryInterface;
use Stoyanov\Restaurants\Model\RestaurantFactory;


class Delete extends Action
{
    public function __construct(
        Context $context,
        private PageFactory $pageFactory,
        private RestaurantRepositoryInterface $repository,
        private RestaurantFactory $factory
    ) {
        parent::__construct($context);
    }

    public function execute()
    {
        if ($this->_request->isPost()) {
            $model = $this->factory->create();
            $restaurant = $model->load($this->_request->getParams()["id"]);
            if ($this->repository->delete($restaurant)) $this->_redirect('restaurants/restaurant/index');
            $this->messageManager->addSuccess(__('The restaurant is deleted!'));
        }
        return $this->pageFactory->create();
    }
}
