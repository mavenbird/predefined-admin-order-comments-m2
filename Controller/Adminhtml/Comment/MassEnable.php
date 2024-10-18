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
namespace Mavenbird\PredefinedAdminOrderComments\Controller\Adminhtml\Comment;

use Mavenbird\PredefinedAdminOrderComments\Model\Comment;

class MassEnable extends AbstractMassAction
{
    /**
     * Execute action
     *
     * @param AbstractCollection $collection
     * @return void
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    protected function massAction($collection)
    {
        $count = 0;
        foreach ($collection as $comment) {
            $commentDataObject = $this->commentRepository->getById($comment->getCommentId());
            $commentDataObject->setIsActive(Comment::STATUS_ENABLED);
            $this->commentRepository->save($commentDataObject);
            $count++;
        }
        
        if ($count) {
            $this->messageManager->addSuccessMessage(__('A total of %1 record(s) have been enabled.', $count));
        }
    }
}
