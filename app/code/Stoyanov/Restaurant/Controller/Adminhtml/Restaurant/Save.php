<?php
declare(strict_types=1);

namespace Stoyanov\Restaurant\Controller\Adminhtml\Restaurant;

use Magento\Backend\App\Action;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;

class Save extends Action implements HttpGetActionInterface
{
    public const string ADMIN_RESOURCE = 'Stoyanov_Restaurant::restaurant_save';

    /**
     * @param Context $context
     */
    public function __construct(
        Context $context,
    ) {
        parent::__construct($context);
    }

    /**
     *
     * @return Redirect
     */
    public function execute(): Redirect
    {
        //TODO FIX SAVE ACTION FROM NEW ACTION AND EDIT PAGE SUBMIT FORM
        //TODO IMPLEMENT SAVE Restaurant logic for edit or new forms
        var_dump("SAVE METHOD WORKS");
        die;
        $redirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        return $redirect->setPath('*/*/index');
    }
}
