<?php
declare(strict_types=1);

namespace Stoyanov\Restaurant\Block\Restaurant;

use Magento\Framework\View\Element\Template;
use Stoyanov\Restaurant\Api\Data\RestaurantInterface;
use Stoyanov\Restaurant\Api\RestaurantManagerInterface;
use Stoyanov\Restaurant\Api\FormInterface;
use Magento\Framework\Exception\LocalizedException;

class Edit extends Template implements FormInterface
{
    public function __construct(
        Template\Context $context,
        private RestaurantManagerInterface $manager,
        array $data = []
    ) {
        parent::__construct($context, $data);
    }

    /**
     * @return string
     */
    public function getFormAction(): string
    {
        // URL for form submission (Save controller)
        $id = $this->getRequest()->getParam('id');
        return $this->getUrl('restaurants/restaurant/update', ['id' => $id]);
    }

    /**
     * @param $id
     * @return RestaurantInterface
     * @throws LocalizedException
     */
    public function getRestaurant($id = null): RestaurantInterface
    {
        if (!$id) $id = (int) $this->getRequest()->getParam('id');
        $restaurant = $this->manager->getRestaurant($id);
        $restaurant->load($id);
        return $restaurant;
    }
}
