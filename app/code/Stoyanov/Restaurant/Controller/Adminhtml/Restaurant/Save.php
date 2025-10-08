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
     * @return ResponseInterface|Redirect|ResultInterface|void
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

    private function processReturn(ModelRestaurant $model, array $data, Redirect $resultRedirect): Redirect
    {
        $redirect = $data['back'] ?? 'close';

        if ($redirect ==='continue') {
            $resultRedirect->setPath('*/*/edit', ['id' => $model->getId()]);
        } elseif ($redirect === 'close') {
            $resultRedirect->setPath('*/*/');
        } elseif ($redirect === 'duplicate') {
            $duplicateModel = $this->restaurantFactory->create(['data' => $data]);
            $duplicateModel->setId(null);
            $duplicateModel->setCapacity($data['capacity']);
            $duplicateModel->setName($data['name']);
            $duplicateModel->setLocation($data['location']);

            $this->restaurantRepository->save($duplicateModel);
            $id = $duplicateModel->getId();
            $this->messageManager->addSuccessMessage(__('You duplicated the Restaurant.'));
            $this->dataPersistor->set('stoyanov_restaurant', $data);
            $resultRedirect->setPath('*/*/edit', ['id' => $id]);
        }
        return $resultRedirect;
    }
}
