<?php
declare(strict_types=1);

namespace Stoyanov\Restaurant\Controller\Adminhtml\Restaurant;

use Magento\{
    Framework\App\Action\HttpPostActionInterface,
    Framework\Controller\ResultFactory,
    Backend\App\Action\Context,
    Ui\Component\MassAction\Filter,
    Backend\App\Action,
    Backend\Model\View\Result\Redirect};

use Stoyanov\Restaurant\Model\ResourceModel\Restaurant\CollectionFactory;
/**
 * Class MassDelete
 */
class MassDelete extends  Action implements HttpPostActionInterface
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Stoyanov_Restaurant::restaurant_delete';

    /**
     * @param Context $context
     * @param Filter $filter
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(protected Context $context, protected Filter $filter, protected CollectionFactory $collectionFactory)
    {
        parent::__construct($context);
    }

    /**
     * Execute action
     *
     * @return Redirect
     * @throws \Magento\Framework\Exception\LocalizedException|\Exception
     */
    public function execute(): Redirect
    {
        $collection = $this->filter->getCollection($this->collectionFactory->create());
        $collectionSize = $collection->getSize();

        foreach ($collection as $page) {
            $page->delete();
        }

        $this->messageManager->addSuccessMessage(__('A total of %1 record(s) have been deleted.', $collectionSize));

        /** @var Redirect $resultRedirect */
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);

        return $resultRedirect->setPath('*/*/');
    }
}
