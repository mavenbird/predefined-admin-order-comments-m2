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
namespace Mavenbird\PredefinedAdminOrderComments\Model;

use Magento\Framework\Model\AbstractModel;
use Magento\Framework\Model\Context;
use Magento\Framework\Registry;
use Mavenbird\PredefinedAdminOrderComments\Api\Data\CommentInterface;
use Mavenbird\PredefinedAdminOrderComments\Model\ResourceModel\Comment as ResourceComment;
use Mavenbird\PredefinedAdminOrderComments\Model\ResourceModel\Comment\Collection;

class Comment extends AbstractModel implements CommentInterface
{
    public const STATUS_ENABLED    = 1;
    public const STATUS_DISABLED   = 0;

    /**
     * Constructs
     *
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Mavenbird\PredefinedAdminOrderComments\Model\ResourceModel\Comment|null $resource
     * @param \Mavenbird\PredefinedAdminOrderComments\Model\ResourceModel\Comment\Collection|null $resourceCollection
     */
    public function __construct(
        Context $context,
        Registry $registry,
        ?ResourceComment $resource = null,
        ?Collection $resourceCollection = null
    ) {
        parent::__construct($context, $registry, $resource, $resourceCollection);
    }
    /**
     * Constructs
     *
     * @return void
     */
    public function _construct()
    {
        $this->_init(ResourceComment::class);
    }

    /**
     * Retrieve comment id
     *
     * @return int
     */
    public function getCommentId()
    {
        return $this->getData(self::COMMENT_ID);
    }

    /**
     * Retrieve title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->getData(self::TITLE);
    }

    /**
     * Retrieve content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->getData(self::CONTENT);
    }

    /**
     * Retrieve comment creation time
     *
     * @return string
     */
    public function getCreationTime()
    {
        return $this->getData(self::CREATION_TIME);
    }

    /**
     * Retrieve comment update time
     *
     * @return string
     */
    public function getUpdateTime()
    {
        return $this->getData(self::UPDATE_TIME);
    }

    /**
     * Get Is active
     *
     * @return bool
     */
    public function getIsActive()
    {
        return (bool)$this->getData(self::IS_ACTIVE);
    }

    /**
     * Set Comment ID
     *
     * @param int $id
     * @return CommentInterface
     */
    public function setCommentId($id)
    {
        return $this->setData(self::COMMENT_ID, $id);
    }

    /**
     * Set title
     *
     * @param string $title
     * @return CommentInterface
     */
    public function setTitle($title)
    {
        return $this->setData(self::TITLE, $title);
    }

    /**
     * Set content
     *
     * @param string $content
     * @return CommentInterface
     */
    public function setContent($content)
    {
        return $this->setData(self::CONTENT, $content);
    }

    /**
     * Set creation time
     *
     * @param string $creationTime
     * @return CommentInterface
     */
    public function setCreationTime($creationTime)
    {
        return $this->setData(self::CREATION_TIME, $creationTime);
    }

    /**
     * Set update time
     *
     * @param string $updateTime
     * @return CommentInterface
     */
    public function setUpdateTime($updateTime)
    {
        return $this->setData(self::UPDATE_TIME, $updateTime);
    }

    /**
     * Set is active
     *
     * @param bool|int $isActive
     * @return CommentInterface
     */
    public function setIsActive($isActive)
    {
        return $this->setData(self::IS_ACTIVE, (string) $isActive);
    }

    /**
     * Prepare comment's statuses
     *
     * @return array
     */
    public function getAvailableStatuses()
    {
        return [self::STATUS_ENABLED => __('Enabled'), self::STATUS_DISABLED => __('Disabled')];
    }

    /**
     * Receive comment store ids
     *
     * @return int[]
     */
    public function getStores()
    {
        return $this->hasData('stores') ? $this->getData('stores') : $this->getData('store_id');
    }

    /**
     * Receive comment order status
     *
     * @return string[]
     */
    public function getOrderStatuses()
    {
        return $this->hasData('order_statuses') ? $this->getData('order_statuses') : $this->getData('order_status');
    }
}
