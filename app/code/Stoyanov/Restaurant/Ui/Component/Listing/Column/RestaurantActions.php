<?php
declare(strict_types=1);

namespace Stoyanov\Restaurant\Ui\Component\Listing\Column;

use Magento\Framework\UrlInterface;
use Magento\Ui\Component\Listing\Columns\Column;

class RestaurantActions extends Column
{
    /** @var string get restaurant edit action link */
    public const string URL_PATH_EDIT   = 'restaurants/restaurant/edit';

    /**
     * @param \Magento\Framework\View\Element\UiComponent\ContextInterface $context
     * @param \Magento\Framework\View\Element\UiComponentFactory $uiComponentFactory
     * @param UrlInterface $urlBuilder
     * @param array $components
     * @param array $data
     */
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
     *
     * @param array $dataSource
     *
     * @return array
     */
    public function prepareDataSource(array $dataSource): array
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as &$item) {
                if (isset($item['entity_id'])) {
                    $item[$this->getData('name')] = [
                        'edit' => [
                            'href'  => $this->urlBuilder->getUrl(
                                self::URL_PATH_EDIT,
                                ['id' => $item['entity_id']]
                            ),
                            'label' => __('Edit')
                        ],
                    ];
                }
            }
        }

        return $dataSource;
    }
}
