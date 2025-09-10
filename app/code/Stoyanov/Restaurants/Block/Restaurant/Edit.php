<?php
declare(strict_types=1);

namespace Stoyanov\Restaurants\Block\Restaurant;

use Magento\Framework\View\Element\Template;
use Stoyanov\Restaurants\Helper\Data as Helper;

class Edit extends Template
{
    public function __construct(
        Template\Context $context,
        private Helper $helper,
        array $data = []
    ) {
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
        if (!$id) $id = (int) $this->getRequest()->getParam('id');
        $restaurant = $this->helper->getRestaurant($id);
        $restaurant->load($id);
        return $restaurant;
    }
}
