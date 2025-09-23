<?php
declare(strict_types=1);

namespace Stoyanov\Restaurant\Block\Adminhtml\New;

use Magento\Backend\Block\Widget\Context;

class GenericButton
{

    /**
     * @param Context $context
     * @param PageRepositoryInterface $pageRepository
     */
    public function __construct(
        protected Context $context,
    ) {
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
