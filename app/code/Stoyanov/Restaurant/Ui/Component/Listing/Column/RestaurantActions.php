<?php
declare(strict_types=1);

namespace Stoyanov\Restaurant\Ui\Component\Listing\Column;

use Magento\Framework\UrlInterface;
use Magento\Ui\Component\Listing\Columns\Column;

class RestaurantActions extends Column
{
    const URL_PATH_EDIT   = 'restaurants/restaurant/edit';
    const URL_PATH_DELETE = 'restaurants/restaurant/delete';

    public function __construct(
        \Magento\Framework\View\Element\UiComponent\ContextInterface $context,
        \Magento\Framework\View\Element\UiComponentFactory $uiComponentFactory,
        protected UrlInterface $urlBuilder,
        array $components = [],
        array $data = []
    ) {
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    /**
     * Add actions (Edit / Delete) for each row
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data'])) {
            foreach ($dataSource['data'] as &$item) {
                if (isset($item['entity_id'])) {
                    $item[$this->getData('name')] = [
                        'edit' => [
                            'href'  => $this->urlBuilder->getUrl(
                                self::URL_PATH_EDIT,
                                ['id' => $item['entity_id']]
                            ),
                            'label' => __('Edit')
                        ],
                        'delete' => [
                            'href'    => $this->urlBuilder->getUrl(
                                self::URL_PATH_DELETE,
                                ['id' => $item['entity_id']]
                            ),
                            'label'   => __('Delete'),
                            'confirm' => [
                                'title'   => __('Delete Restaurant'),
                                'message' => __('Are you sure you want to delete the restaurant "%1"?', $item['name'])
                            ]
                        ]
                    ];
                }
            }
        }

        return $dataSource;
    }
}
