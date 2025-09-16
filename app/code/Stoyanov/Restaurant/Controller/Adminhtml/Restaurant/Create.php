<?php
declare(strict_types=1);

namespace Stoyanov\Restaurant\Controller\Adminhtml\Restaurant;

use Magento\Backend\App\Action;
use Magento\Framework\View\Result\PageFactory;
use Stoyanov\Restaurant\Api\RequestRestaurantInterface;

class Create extends Action
{
    const ADMIN_RESOURCE = 'Stoyanov_Restaurant::restaurant_create';

    public function __construct(
        Action\Context $context,
        protected PageFactory $resultPageFactory,
        private RequestRestaurantInterface $requestRestaurant
    ) {
        parent::__construct($context);
    }

    public function execute()
    {
        if ($this->_request->isPost()) {
            $response = $this->requestRestaurant->createOrUpdate($this->_request->getParams());
            if (!empty($response['entity_id'])) {
                $this->_redirect('restaurants/restaurant/edit', ['id' => $response['entity_id']]);
                $this->messageManager->addSuccess(__('New restaurant is created!'));
            }
        }
        return $this->resultPageFactory->create();
    }
}
