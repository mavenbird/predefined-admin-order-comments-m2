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
namespace Mavenbird\PredefinedAdminOrderComments\Controller\Adminhtml;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Backend\App\Action;
use Mavenbird\PredefinedAdminOrderComments\Api\CommentRepositoryInterface as CommentRepository;

abstract class Comment extends Action
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    public const ADMIN_RESOURCE = 'Mavenbird_PredefinedAdminOrderComments::admin_order_comments';

    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @var CommentRepository
     */
    protected $commentRepository;

    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     * @param CommentRepository $commentRepository
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        CommentRepository $commentRepository
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->commentRepository = $commentRepository;
        parent::__construct($context);
    }

    /**
     * Init page
     *
     * @param \Magento\Backend\Model\View\Result\Page $resultPage
     * @return \Magento\Backend\Model\View\Result\Page
     */
    protected function initPage($resultPage)
    {
        $resultPage->setActiveMenu('Mavenbird_PredefinedAdminOrderComments::predefined')
            ->addBreadcrumb(__('Predefined Admin Order Comments'), __('Predefined Admin Order Comments'))
            ->addBreadcrumb(__('Manage Predefined Admin Order Comments'), __('Manage Predefined Admin Order Comments'));
        return $resultPage;
    }
}
