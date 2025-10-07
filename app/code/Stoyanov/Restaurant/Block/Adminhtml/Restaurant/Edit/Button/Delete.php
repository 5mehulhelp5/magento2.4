<?php
declare(strict_types=1);

namespace Stoyanov\Restaurant\Block\Adminhtml\Restaurant\Edit\Button;

use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class Delete extends Generic implements ButtonProviderInterface
{
    /**
     * Get Button Data
     *
     * @return array
     *
     * @throws LocalizedException
     */
    public function getButtonData(): array
    {
        $data = [];
        if ($this->getPageId()) {
            $data = [
                'label' => __('Delete Restaurant'),
                'class' => 'delete',
                'on_click' => 'deleteConfirm(\'' . __(
                    'Are you sure you want to do this?'
                ) .
                    '\', \''
                    . $this->getDeleteUrl() . '\', {"data": {}})', 'sort_order' => 20];
        }
        return $data;
    }

    /**
     * Url to send delete requests to.
     *
     * @return string
     *
     * @throws LocalizedException
     */
    public function getDeleteUrl(): string
    {
        return $this->getUrl('*/*/delete', ['id' => $this->getPageId()]);
    }
}
