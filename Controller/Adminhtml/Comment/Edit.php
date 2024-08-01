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

use Magento\Framework\Exception\NoSuchEntityException;

use Mavenbird\PredefinedAdminOrderComments\Controller\Adminhtml\Comment;

class Edit extends Comment
{
    /**
     * Edit Comment
     *
     * @return \Magento\Backend\Model\View\Result\Page|\Magento\Backend\Model\View\Result\Redirect
     * @throws NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function execute()
    {
        $id = (int) $this->getRequest()->getParam('comment_id');
        if ($id) {
            try {
                $comment = $this->commentRepository->getById($id);
            } catch (NoSuchEntityException $e) {
                $this->messageManager->addExceptionMessage(
                    $e,
                    __('Something went wrong while editing the comment.')
                );
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/index');
            }
        }
        
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage
            ->setActiveMenu('Mavenbird_PredefinedAdminOrderComments::admin_order_comments')
            ->getConfig()->getTitle()->prepend(
                $id ? $comment->getTitle() : __('New Comment')
            );

        return $resultPage;
    }
}
