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
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Exception\LocalizedException;
use Mavenbird\PredefinedAdminOrderComments\Api\CommentRepositoryInterface as CommentRepository;
use Mavenbird\PredefinedAdminOrderComments\Model\CommentFactory;
use Mavenbird\PredefinedAdminOrderComments\Controller\Adminhtml\Comment;
use Mavenbird\PredefinedAdminOrderComments\Model\Comment as CommentModel;

class Save extends Comment
{
    /**
     * @var DataPersistorInterface
     */
    private $dataPersistor;

    /**
     * @var CommentFactory
     */
    private $commentFactory;

    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     * @param CommentRepository $commentRepository
     * @param DataPersistorInterface $dataPersistor
     * @param CommentFactory $commentFactory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        CommentRepository $commentRepository,
        DataPersistorInterface $dataPersistor,
        CommentFactory $commentFactory
    ) {
        $this->dataPersistor = $dataPersistor;
        $this->commentFactory = $commentFactory;
        parent::__construct($context, $resultPageFactory, $commentRepository);
    }

    /**
     * Save action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($data) {
            $id = $this->getRequest()->getParam('comment_id');

            if (empty($data['comment_id'])) {
                $data['comment_id'] = null;
            }

            try {
                /** @var \Mavenbird\PredefinedAdminOrderComments\Model\Comment $model */
                $model = $this->commentFactory->create();
                if ($id) {
                    try {
                        $model = $this->commentRepository->getById($id);
                    } catch (LocalizedException $e) {
                        $this->messageManager->addErrorMessage(__('This comment no longer exists.'));
                        return $resultRedirect->setPath('*/*/');
                    }
                }

                $model->setData($data);

                $comment = $this->commentRepository->save($model);
                $this->messageManager->addSuccessMessage(__('The Comment has been saved.'));
                $this->dataPersistor->clear('predefined_admin_order_comments');
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['comment_id' => $comment->getCommentId(), '_current' => true]);
                }
                return $resultRedirect->setPath('*/*/index');
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\RuntimeException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the comment.'));
            }

            $this->dataPersistor->set('predefined_admin_order_comments', $data);
            return $resultRedirect->setPath('*/*/edit', ['comment_id' => $this->getRequest()->getParam('comment_id')]);
        }
        return $resultRedirect->setPath('*/*/index');
    }
}
