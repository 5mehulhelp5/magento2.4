<?php
declare(strict_types=1);

namespace Stoyanov\Restaurant\Controller\Adminhtml\Restaurant;

use Magento\Backend\App\Action;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Stoyanov\Restaurant\Api\RequestRestaurantInterface;
use Magento\Framework\Event\ManagerInterface;

class Save extends Action implements HttpPostActionInterface
{
    public const string ADMIN_RESOURCE = 'Stoyanov_Restaurant::restaurant_save';

    /**
     * @param Context $context
     * @param RequestRestaurantInterface $requestRestaurant
     * @param ManagerInterface $eventManager
     */
    public function __construct(
        private Context $context,
        private RequestRestaurantInterface $requestRestaurant,
        private ManagerInterface $eventManager
    ) {
        parent::__construct($context);
    }

    /**
     * Save Restaurant
     *
     * @return Redirect
     */
    public function execute(): Redirect
    {
        $post = $this->getRequest()->getPost()->toArray();
        $response = $this->requestRestaurant->createOrUpdate($post);
        if (!empty($response['entity_id'])) {
            // 🔹 Dispatch custom event
            $this->eventManager->dispatch(
                'new_restaurant_created',
                ['restaurant' => $response]
            );
            $this->messageManager->addSuccess(__('A new restaurant is created!'));
        }

        $redirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        return $redirect->setPath('*/*/index');
    }
}
