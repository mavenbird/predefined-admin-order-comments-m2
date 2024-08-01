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

use Magento\Framework\EntityManager\Operation\ExtensionInterface;
use Mavenbird\PredefinedAdminOrderComments\Api\Data\CommentInterface;
use Mavenbird\PredefinedAdminOrderComments\Model\ResourceModel\Comment;
use Magento\Framework\EntityManager\MetadataPool;

class SaveHandler implements ExtensionInterface
{
    /**
     * @var MetadataPool
     */
    protected $metadataPool;

    /**
     * @var Comment
     */
    protected $resourceComment;

    /**
     * @param MetadataPool $metadataPool
     * @param Comment $resourceComment
     */
    public function __construct(
        MetadataPool $metadataPool,
        Comment $resourceComment
    ) {
        $this->metadataPool = $metadataPool;
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
        $entityMetadata = $this->metadataPool->getMetadata(CommentInterface::class);
        $linkField = $entityMetadata->getLinkField();

        $connection = $entityMetadata->getEntityConnection();

        $oldOrderStatuses = $this->resourceComment->lookupOrderStatuses((int)$entity->getId());
        $newOrderStatuses = (array)$entity->getOrderStatus();

        $table = $this->resourceComment->getTable('mavenbird_predefined_admin_order_comments_status');

        $delete = array_diff($oldOrderStatuses, $newOrderStatuses);

        if ($delete) {
            $where = [
                $linkField . ' = ?' => (int)$entity->getData($linkField),
                'status IN (?)' => $delete,
            ];
            $connection->delete($table, $where);
        }

        $insert = array_diff($newOrderStatuses, $oldOrderStatuses);
        if ($insert) {
            $data = [];
            foreach ($insert as $status) {
                $data[] = [
                    $linkField => (int)$entity->getData($linkField),
                    'status' => $status,
                ];
            }
            $connection->insertMultiple($table, $data);
        }

        return $entity;
    }
}
