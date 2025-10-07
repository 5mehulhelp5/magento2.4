<?php
declare(strict_types=1);

namespace Stoyanov\Restaurant\Block\Restaurant;

use Stoyanov\Restaurant\Api\Data\RestaurantInterface;
use Stoyanov\Restaurant\Api\RestaurantManagerInterface;
use Stoyanov\Restaurant\Api\FormInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\View\Element\Template;

class Edit extends Template implements FormInterface
{
    /**
     * @param Template\Context $context
     * @param RestaurantManagerInterface $manager
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        private RestaurantManagerInterface $manager,
        array $data = []
    ) {
        parent::__construct($context, $data);
    }

    /**
     * Get Form Action
     *
     * @return string
     */
    public function getFormAction(): string
    {
        // URL for form submission (Save controller)
        $id = (int) $this->getRequest()->getParam('id');
        return $this->getUrl('restaurants/restaurant/update', ['id' => $id]);
    }

    /**
     * Get Restaurant
     *
     * @param $id
     *
     * @return RestaurantInterface
     *
     * @throws LocalizedException
     */
    public function getRestaurant($id = null): RestaurantInterface
    {
        if (!$id) {
            $id = (int) $this->getRequest()->getParam('id');
        }
        $restaurant = $this->manager->getRestaurant($id);
        $restaurant->load($id);
        return $restaurant;
    }
}
