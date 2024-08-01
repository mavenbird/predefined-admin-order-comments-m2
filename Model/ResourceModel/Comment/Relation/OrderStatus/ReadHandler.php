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
namespace Mavenbird\PredefinedAdminOrderComments\Model\ResourceModel\Comment\Relation\OrderStatus;

use Mavenbird\PredefinedAdminOrderComments\Model\ResourceModel\Comment;
use Magento\Framework\EntityManager\Operation\ExtensionInterface;

class ReadHandler implements ExtensionInterface
{
    /**
     * @var Comment
     */
    protected $resourceComment;

    /**
     * @param Comment $resourceComment
     */
    public function __construct(
        Comment $resourceComment
    ) {
        $this->resourceComment = $resourceComment;
    }

    /**
     * Executes
     *
     * @param mixed $entity
     * @param mixed $arguments
     * @return mixed
     */
    public function execute($entity, $arguments = [])
    {
        if ($entity->getId()) {
            $orderStatuses = $this->resourceComment->lookupOrderStatuses((int)$entity->getId());
            $entity->setData('order_statuses', $orderStatuses);
            $entity->setData('order_status', $orderStatuses);
        }
        return $entity;
    }
}
