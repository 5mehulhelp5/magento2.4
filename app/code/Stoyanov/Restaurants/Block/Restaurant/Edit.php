<?php
declare(strict_types=1);

namespace Stoyanov\Restaurants\Block\Restaurant;

use Magento\Framework\View\Element\Template;
use Stoyanov\Restaurants\Helper\Data as RestaurantHelper;

class Edit extends Template
{
    private $restaurantHelper;

    public function __construct(
        Template\Context $context,
        RestaurantHelper $restaurantHelper,
        array $data = []
    ) {
        $this->restaurantHelper = $restaurantHelper;
        parent::__construct($context, $data);
    }

    public function getFormAction()
    {
        // URL for form submission (Save controller)
        $id = $this->getRequest()->getParam('id');
        return $this->getUrl('stoyanov/restaurant/update', ['id' => $id]);
    }

    public function getRestaurant($id = null)
    {
        if (!$id) {
            $id = (int) $this->getRequest()->getParam('id');
        }
        $restaurant = $this->restaurantHelper->getRestaurant($id);
        if ($id) {
            $restaurant->load($id);
        }
        return $restaurant;
    }
}
