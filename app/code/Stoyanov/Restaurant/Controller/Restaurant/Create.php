<?php

declare(strict_types=1);

namespace Stoyanov\Restaurant\Controller\Restaurant;

use Magento\Framework\App\Action\{Action, Context};
use Magento\Framework\View\Result\{PageFactory, Page};
use \Stoyanov\Restaurant\Api\RequestRestaurantInterface;
use Magento\Framework\Event\ManagerInterface;

class Create extends Action
{
    public function __construct(
        Context $context,
        private PageFactory $pageFactory,
        private RequestRestaurantInterface $requestRestaurant,
        private ManagerInterface $eventManager
    ) {
        parent::__construct($context);
    }

    public function execute(): Page
    {
        if ($this->_request->isPost()) {
            $response = $this->requestRestaurant->createOrUpdate($this->_request->getParams());
            if (!empty($response['entity_id'])) {
                // 🔹 Dispatch custom event
                $this->eventManager->dispatch(
                    'new_restaurant_created',
                    ['restaurant' => $response]
                );
                $this->messageManager->addSuccess(__('A new restaurant is created!'));
            }
        }
        return $this->pageFactory->create();
    }
}
