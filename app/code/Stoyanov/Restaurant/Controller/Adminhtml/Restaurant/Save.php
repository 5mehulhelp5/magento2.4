<?php
declare(strict_types=1);

namespace Stoyanov\Restaurant\Controller\Adminhtml\Restaurant;

use Magento\Backend\App\Action;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\Registry;
use Stoyanov\Restaurant\Controller\Adminhtml\Restaurant;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Exception\LocalizedException;
use Stoyanov\Restaurant\Model\RestaurantFactory;
use Stoyanov\Restaurant\Api\RestaurantRepositoryInterface;

class Save extends Restaurant implements HttpGetActionInterface
{
    public function __construct(
        protected Action\Context $context,
        protected Registry $coreRegistry,
        protected DataPersistorInterface $dataPersistor,
        private ?RestaurantFactory $restaurantFactory,
        private ?RestaurantRepositoryInterface $restaurantRepository
    ) {
        parent::__construct($context, $coreRegistry);
    }

    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();
        if ($data) {
            if (empty($data['entity_id'])) {
                $data['entity_id'] = null;
            }
            $model = $this->restaurantFactory->create();
            $id = $this->getRequest()->getParam('id');
            if ($id) {
                try {
                    $model = $this->restaurantRepository->getById($id);
                } catch (LocalizedException $e) {
                    $this->messageManager->addErrorMessage(__('This Restaurant no longer exists.'));
                    return $resultRedirect->setPath('*/*/');
                }
            }

        }
        $model->setData($data);

        try {
            $this->restaurantRepository->save($model);
            $this->messageManager->addSuccessMessage(__('You saved the restaurant.'));
            $this->dataPersistor->clear('stoyanov_restaurant');
            return $this->processReturn($model, $data, $resultRedirect);
        } catch (LocalizedException $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
        } catch (\Exception $e) {
            $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the block.'));
        }
    }

    /**
     * @throws LocalizedException
     */
    private function processReturn($model, $data, $resultRedirect)
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
