<?php
declare(strict_types=1);

namespace Stoyanov\Restaurant\Block\Adminhtml\Restaurant\Edit\Button;

use Magento\Backend\Block\Widget\Context;
use Magento\Framework\Exception\NoSuchEntityException;
use Stoyanov\Restaurant\Api\RestaurantRepositoryInterface;

class Generic
{

    /**
     * @param Context $context
     * @param RestaurantRepositoryInterface $restaurantRepository
     */
    public function __construct(
        protected Context $context,
        protected RestaurantRepositoryInterface $restaurantRepository
    ) {
    }

    /**
     * Get Page Id
     *
     * @return mixed|null
     *
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getPageId()
    {
        try {
            $id = (int) $this->context->getRequest()->getParam('id');
            if ($id) {
                return $this->restaurantRepository->getById($id)->getId();
            }
        } catch (NoSuchEntityException $e) {
        }
        return null;
    }

    /**
     * Generate url by route and parameters
     *
     * @param string $route
     * @param array $params
     *
     * @return string
     */
    public function getUrl(string $route = '', array $params = []): string
    {
        return $this->context->getUrlBuilder()->getUrl($route, $params);
    }
}
