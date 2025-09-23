<?php
declare(strict_types=1);

namespace Stoyanov\Restaurant\Block\Adminhtml\Page\Edit;

use Magento\Backend\Block\Widget\Context;
use Magento\Framework\Exception\NoSuchEntityException;
use Stoyanov\Restaurant\Api\RestaurantRepositoryInterface;

class GenericButton
{

    /**
     * @param Context $context
     * @param PageRepositoryInterface $pageRepository
     */
    public function __construct(
        protected Context $context,
        protected RestaurantRepositoryInterface $restaurantRepository
    ) {
    }

    public function getPageId()
    {
        try {
            return $this->restaurantRepository->getById(
                $this->context->getRequest()->getParam('block_id')
            )->getId();
        } catch (NoSuchEntityException $e) {
        }
        return null;
    }


    /**
     * Generate url by route and parameters
     *
     * @param   string $route
     * @param   array $params
     * @return  string
     */
    public function getUrl($route = '', $params = [])
    {
        return $this->context->getUrlBuilder()->getUrl($route, $params);
    }
}
