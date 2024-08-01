<?php
/**
 * Mavenbird Technologies Private Limited
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the EULA
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://mavenbird.com/Mavenbird-Module-License.txt
 *
 * =================================================================
 *
 * @category   Mavenbird
 * @package    Mavenbird_PredefinedAdminOrderComments
 * @author     Mavenbird Team
 * @copyright  Copyright (c) 2018-2024 Mavenbird Technologies Private Limited ( http://mavenbird.com )
 * @license    http://mavenbird.com/Mavenbird-Module-License.txt
 */ 
namespace Mavenbird\PredefinedAdminOrderComments\Ui\Component\Listing\Column;

use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Mavenbird\PredefinedAdminOrderComments\Api\CommentRepositoryInterface as CommmetRepository;
use Magento\Ui\Component\Listing\Columns\Column;
use Magento\Sales\Model\ResourceModel\Order\Status\CollectionFactory;

class OrderStatuses extends Column
{
    /**
     * @var CommmetRepository
     */
    protected $commentRepository;

    /**
     * Order Status Collections
     *
     * @var OrderStatusCollection
     */
    protected $orderStatusCollection;

    /**
     * Constructor
     *
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param CommmetRepository $commentRepository
     * @param CollectionFactory $orderStatusCollection
     * @param array $components
     * @param array $data
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        CommmetRepository $commentRepository,
        CollectionFactory $orderStatusCollection,
        array $components = [],
        array $data = []
    ) {
        parent::__construct($context, $uiComponentFactory, $components, $data);
        $this->commentRepository = $commentRepository;
        $this->orderStatusCollection = $orderStatusCollection;
    }

    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     * @return array
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            $fieldName = $this->getData('name');
            $statusLabel = [];
            $statuses = $this->orderStatusCollection->create()->load()->toOptionHash();
            foreach ($dataSource['data']['items'] as & $item) {
                $commentId = $item['comment_id'];
                $comment = $this->commentRepository->getById($commentId);
                $commentOrderStatuses = $comment->getOrderStatuses();
                foreach ($commentOrderStatuses as $orderStatus) {
                    $statusLabel[] = $statuses[$orderStatus];
                }
                $item[$fieldName] = implode(',', $statusLabel);
            }
        }

        return $dataSource;
    }
}
