<?php

declare(strict_types=1);

namespace Stoyanov\Restaurant\Controller\Restaurant;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\View\Result\Page;

class Index extends Action
{
    /**
     * @param Context $context
     * @param PageFactory $pageFactory
     */
    public function __construct(
        Context $context,
        private PageFactory $pageFactory
    ) {
        parent::__construct($context);
    }

    /**
     * Index Restaurant Action
     *
     * @return Page
     */
    public function execute(): Page
    {
        return $this->pageFactory->create();
    }
}
