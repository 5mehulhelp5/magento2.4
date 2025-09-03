<?php

declare(strict_types=1);

namespace Stoyanov\Restaurants\Controller\Restaurant;

use Magento\Framework\App\Action\{Action, Context};
use Magento\Framework\View\Result\PageFactory;
use Stoyanov\Restaurants\Helper\Data;

class Create extends Action
{
    private $data;
    public function __construct(
        Context                       $context,
        private PageFactory           $pageFactory,
        Data                          $data,

    ) {
        $this->data = $data;
        parent::__construct($context);

    }

    public function execute()
    {
        if ($this->_request->isPost()) {
            $response = $this->data->createOrUpdateRestaurant($this->_request->getParams());
            if (!empty($response['entity_id'])) {
                $this->messageManager->addSuccess(__('A new restaurant is created!'));
            }
        }
        return $this->pageFactory->create();
    }
}
