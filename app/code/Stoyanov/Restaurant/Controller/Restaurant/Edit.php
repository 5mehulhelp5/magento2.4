<?php

declare(strict_types=1);

namespace Stoyanov\Restaurant\Controller\Restaurant;

use Magento\Framework\ {
    App\Action\Action,
    App\Action\Context,
    View\Result\PageFactory,
    View\Result\Page,
};

class Edit extends Action
{
    public function __construct(Context $context, protected PageFactory $resultPageFactory)
    {
        parent::__construct($context);
    }

    public function execute(): Page
    {
        return $this->resultPageFactory->create();
    }
}
