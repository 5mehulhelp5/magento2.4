<?php
declare(strict_types=1);

namespace Stoyanov\Restaurant\Block\Adminhtml\Restaurant\Edit\Button;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class Save extends Generic implements ButtonProviderInterface
{
    /**
     * Get Button Data
     *
     * @return array
     */
    public function getButtonData()
    {
        return [
            'label' => __('Save'),
            'class' => 'save primary',
            'data_attribute' => [
                'mage-init' => [
                    'button' => [
                        'event' => 'save',
                    ],
                ],
            ],
        ];
    }
}
