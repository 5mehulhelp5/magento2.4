<?php

declare(strict_types=1);

namespace Stoyanov\Restaurants\Controller\Restaurant;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Stoyanov\Restaurants\Helper\Data;

class Update extends Action
{
    private $data;
    public function __construct(
        Context                       $context,
        private PageFactory           $pageFactory,
        Data                          $data
    ) {
        $this->data = $data;
        parent::__construct($context);

    }

    public function execute()
    {
        if ($this->_request->isPost()) {
//            $response = $this->helper->createFlight($this->_request);
            if (!empty($response['id'])) {
                $this->_redirect('stoyanov/restaurant/edit', ['id' => $response['id']]);
                $this->messageManager->addSuccess(__('Restaurant is updated!'));
            }
        }
        return $this->pageFactory->create();
    }
}
