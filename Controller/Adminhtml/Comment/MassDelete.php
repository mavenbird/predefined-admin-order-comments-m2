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

class MassDelete extends AbstractMassAction
{
    /**
     * Execute action
     *
     * @param AbstractCollection $collection
     * @return void
     * @throws \Magento\Framework\Exception\LocalizedException
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    protected function massAction($collection)
    {
        $commentsDeleted = 0;
        foreach ($collection->getAllIds() as $commentId) {
            $this->commentRepository->deleteById($commentId);
            $commentsDeleted++;
        }

        if ($commentsDeleted) {
            $this->messageManager->addSuccessMessage(__('A total of %1 record(s) have been deleted.', $commentsDeleted));
        }
    }
}
