<?php

declare(strict_types=1);

namespace Stoyanov\Restaurants\Controller\Restaurant;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Stoyanov\Restaurants\Helper\Data;
use Stoyanov\Restaurants\Api\RestaurantRepositoryInterface;

class Create extends Action
{
    private $data;
    private $restaurantRepository;
    public function __construct(
        Context                       $context,
        private PageFactory           $pageFactory,
        Data                          $data,
        RestaurantRepositoryInterface $restaurantRepository

    ) {
        $this->data = $data;
        $this->restaurantRepository = $restaurantRepository;
        parent::__construct($context);

    }

    public function execute()
    {
        if ($this->_request->isPost()) {
            $data = $this->_request->getParams();
            $data["id"] = $this->calculateEntityIdValue($this->restaurantRepository->getList()->getSize());
            $response = $this->data->createOrUpdateRestaurant($data);
            if (!empty($response['entity_id'])) {
                $this->messageManager->addSuccess(__('A new restaurant is created!'));
            }
        }
        return $this->pageFactory->create();
    }

    private function calculateEntityIdValue($countRestaurants): int
    {
        $entityId = $countRestaurants + 1;
        if ($countRestaurants === 0) $entityId = 1;
        return $entityId;
    }
}
