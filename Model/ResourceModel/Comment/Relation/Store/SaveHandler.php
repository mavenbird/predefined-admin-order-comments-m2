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
namespace Mavenbird\PredefinedAdminOrderComments\Model\ResourceModel\Comment\Relation\Store;

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

        $oldStores = $this->resourceComment->lookupStoreIds((int)$entity->getId());
        $newStores = (array)$entity->getStoreId();

        $table = $this->resourceComment->getTable('mavenbird_predefined_admin_order_comments_store');

        $delete = array_diff($oldStores, $newStores);

        if ($delete) {
            $where = [
                $linkField . ' = ?' => (int)$entity->getData($linkField),
                'store_id IN (?)' => $delete,
            ];
            $connection->delete($table, $where);
        }

        $insert = array_diff($newStores, $oldStores);
        if ($insert) {
            $data = [];
            foreach ($insert as $storeId) {
                $data[] = [
                    $linkField => (int)$entity->getData($linkField),
                    'store_id' => (int)$storeId,
                ];
            }
            $connection->insertMultiple($table, $data);
        }

        return $entity;
    }
}
