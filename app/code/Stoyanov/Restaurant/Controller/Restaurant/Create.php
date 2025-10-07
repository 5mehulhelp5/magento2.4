<?php

declare(strict_types=1);

namespace Stoyanov\Restaurant\Controller\Restaurant;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\View\Result\Page;
use Magento\Framework\Event\ManagerInterface;
use \Stoyanov\Restaurant\Api\RequestRestaurantInterface;

class Create extends Action
{
    /**
     * @param Context $context
     * @param PageFactory $pageFactory
     * @param RequestRestaurantInterface $requestRestaurant
     * @param ManagerInterface $eventManager
     */
    public function __construct(
        Context $context,
        private PageFactory $pageFactory,
        private RequestRestaurantInterface $requestRestaurant,
        private ManagerInterface $eventManager
    ) {
        parent::__construct($context);
    }

    /**
     * Create Restaurant Action
     *
     * @return Page
     */
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
