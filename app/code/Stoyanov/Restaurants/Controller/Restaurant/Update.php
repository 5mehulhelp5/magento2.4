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
            $data = $this->_request->getParams();

            $response = $this->data->updateRestaurant($data);
            if (!empty($response['entity_id'])) {
                $this->_redirect('stoyanov/restaurant/edit', ['id' => $response['entity_id']]);
                $this->messageManager->addSuccess(__('Restaurant is updated!'));
            }
        }
        return $this->pageFactory->create();
    }
}
