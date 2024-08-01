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
namespace Mavenbird\PredefinedAdminOrderComments\Block\Adminhtml\Sales\Order\View;

use \Magento\Backend\Block\Template\Context;
use \Magento\Sales\Helper\Data;
use \Magento\Framework\Registry;
use \Magento\Sales\Helper\Admin;
use \Mavenbird\PredefinedAdminOrderComments\Model\ResourceModel\Comment\CollectionFactory;
use Mavenbird\PredefinedAdminOrderComments\Helper\Data as PredefineData;

class History extends \Magento\Sales\Block\Adminhtml\Order\View\History
{
    /**
     * Predefine Datas
     *
     * @var preDefineData
     */
    protected $predefineData;
    /**
     * @var CollectionFactory
     */
    protected $commentCollectionFactory;

    /**
     * Constructs
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Sales\Helper\Data $salesData
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Sales\Helper\Admin $adminHelper
     * @param \Mavenbird\PredefinedAdminOrderComments\Model\ResourceModel\Comment\CollectionFactory $commentCollectionFactory
     * @param \Mavenbird\PredefinedAdminOrderComments\Helper\Data $predefineData
     * @param array $data
     */
    public function __construct(
        Context $context,
        Data $salesData,
        Registry $registry,
        Admin $adminHelper,
        CollectionFactory $commentCollectionFactory,
        PredefineData $predefineData,
        array $data = []
    ) {
        $this->predefineData = $predefineData;
        parent::__construct($context, $salesData, $registry, $adminHelper, $data, $predefineData);
        $this->commentCollectionFactory = $commentCollectionFactory;
    }

    /**
     * Retrieve all predefined comments for current status
     *
     * @return array
     */
    public function getPredefinedComments()
    {
        $order = $this->getOrder();
        $predefinedComments = $this->commentCollectionFactory->create()
            ->addOrderStatusFilter($order->getStatus())
            ->addStoreFilter($order->getStoreId())
            ->addFieldToFilter('is_active', 1)
            ->toOptionHash();

        return $predefinedComments;
    }

    /**
     * Get Predefine Datas
     *
     * @return PredefineData
     */
    public function getPredefineData()
    {
        return $this->predefineData;
    }
}
