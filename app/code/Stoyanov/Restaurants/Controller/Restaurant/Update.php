<?php

declare(strict_types=1);

namespace Stoyanov\Restaurants\Controller\Restaurant;

use Magento\Framework\App\Action\{Action, Context};
use Magento\Framework\View\Result\PageFactory;
use Stoyanov\Restaurants\Api\RestaurantRequestInterface;

class Update extends Action
{
    public function __construct(
        Context $context,
        private PageFactory $pageFactory,
        private RestaurantRequestInterface $restaurantRequest
    ) {
        parent::__construct($context);
    }

    public function execute()
    {
        if ($this->_request->isPost()) {
            $response = $this->restaurantRequest->createOrUpdateRestaurant($this->_request->getParams());
            if (!empty($response['entity_id'])) {
                $this->_redirect('stoyanov/restaurant/edit', ['id' => $response['entity_id']]);
                $this->messageManager->addSuccess(__('Restaurant is updated!'));
            }
        }
        return $this->pageFactory->create();
    }
}
