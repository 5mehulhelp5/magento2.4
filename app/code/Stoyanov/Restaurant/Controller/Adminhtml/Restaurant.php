<?php
declare(strict_types=1);

namespace Stoyanov\Restaurant\Controller\Adminhtml;
use \Magento\Framework\View\Result\Page;

abstract class Restaurant extends \Magento\Backend\App\Action
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Stoyanov_Restaurant::restaurant_save';

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Registry $coreRegistry
     */
    public function __construct(\Magento\Backend\App\Action\Context $context, protected \Magento\Framework\Registry $coreRegistry)
    {
        parent::__construct($context);
    }

    /**
     * Init page
     *
     * @param Page $resultPage
     * @return Page
     */
    protected function initPage(Page $resultPage): Page
    {
        $resultPage->setActiveMenu('Stoyanov_Restaurant::restaurant_view')
            ->addBreadcrumb(__('Restaurant'), __('Restaurant'));
        return $resultPage;
    }
}
