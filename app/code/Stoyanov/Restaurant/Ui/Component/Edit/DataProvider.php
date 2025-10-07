<?php
declare(strict_types=1);

namespace Stoyanov\Restaurant\Ui\Component\Edit;

use Magento\Ui\DataProvider\AbstractDataProvider;
use Stoyanov\Restaurant\Model\ResourceModel\Restaurant\CollectionFactory;

class DataProvider extends AbstractDataProvider
{
    /** @var array  Collect all restaurants data */
    protected array $loadedData;

    /**
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $collectionFactory
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        string $name,
        string $primaryFieldName,
        string $requestFieldName,
        CollectionFactory $collectionFactory,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $collectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    /**
     * Get Data
     *
     * @return array
     */
    public function getData(): array
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
