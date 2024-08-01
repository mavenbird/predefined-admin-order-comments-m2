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

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Mavenbird\PredefinedAdminOrderComments\Api\CommentRepositoryInterface as CommentRepository;
use Mavenbird\PredefinedAdminOrderComments\Controller\Adminhtml\Comment;

class Index extends Comment
{
    /**
     * Constructs
     *
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     * @param \Mavenbird\PredefinedAdminOrderComments\Api\CommentRepositoryInterface $commentRepository
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        CommentRepository $commentRepository
    ) {
        parent::__construct($context, $resultPageFactory, $commentRepository);
    }

    /**
     * Index action
     *
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage
            ->setActiveMenu('Mavenbird_PredefinedAdminOrderComments::admin_order_comments')
            ->getConfig()->getTitle()->prepend(__('Manage Comments'));

        return $resultPage;
    }
}
