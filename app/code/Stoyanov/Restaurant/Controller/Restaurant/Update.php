<?php

declare(strict_types=1);

namespace Stoyanov\Restaurant\Controller\Restaurant;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\View\Result\Page;
use Stoyanov\Restaurant\Api\RequestRestaurantInterface;

class Update extends Action
{
    /**
     * @param Context $context
     * @param PageFactory $pageFactory
     * @param RequestRestaurantInterface $requestRestaurant
     */
    public function __construct(
        Context $context,
        private PageFactory $pageFactory,
        private RequestRestaurantInterface $requestRestaurant
    ) {
        parent::__construct($context);
    }

    /**
     * Update Restaurant Action
     *
     * @return Page
     */
    public function execute(): Page
    {
        if ($this->_request->isPost()) {
            $response = $this->requestRestaurant->createOrUpdate($this->_request->getParams());
            if (!empty($response['entity_id'])) {
                $this->_redirect('restaurants/restaurant/edit', ['id' => $response['entity_id']]);
                $this->messageManager->addSuccess(__('The restaurant is updated!'));
            }
        }
        return $this->pageFactory->create();
    }
}
