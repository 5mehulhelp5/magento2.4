<?php
declare(strict_types=1);

namespace Stoyanov\Restaurant\Model\Restaurant\New;

use Magento\Ui\DataProvider\AbstractDataProvider;
use Stoyanov\Restaurant\Model\ResourceModel\Restaurant\CollectionFactory;

class DataProvider extends AbstractDataProvider
{
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $collectionFactory,
        array $meta = [],
        array $data = [],

    ) {
        $this->collection = $collectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    public function getData()
    {
        return [];
    }
}
