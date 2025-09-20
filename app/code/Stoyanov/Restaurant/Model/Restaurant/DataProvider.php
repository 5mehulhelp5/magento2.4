<?php
declare(strict_types=1);

namespace Stoyanov\Restaurant\Model\Restaurant;

use Magento\Ui\DataProvider\AbstractDataProvider;
use Stoyanov\Restaurant\Model\ResourceModel\Restaurant\CollectionFactory;

class DataProvider extends AbstractDataProvider
{
    protected $loadedData;

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $collectionFactory,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $collectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }
        $items = $this->collection->getItems();
        foreach ($items as $restaurant) {
            $this->loadedData[$restaurant->getId()] = $restaurant->getData();
        }
        return $this->loadedData ?? [];
    }
}
