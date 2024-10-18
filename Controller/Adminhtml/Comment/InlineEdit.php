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
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Backend\App\Action;
use Mavenbird\PredefinedAdminOrderComments\Api\CommentRepositoryInterface as CommentRepository;
use Mavenbird\PredefinedAdminOrderComments\Api\Data\CommentInterface;

class InlineEdit extends Action
{
    /**
     * @var CommentInterface
     */
    private $commentInterface;

    /**
     * @var JsonFactory
     */
    private $jsonFactory;

    /**
     * @var DataObjectHelper
     */
    private $dataObjectHelper;

    /**
     * @param Context $context
     * @param CommentRepository $commentRepository
     * @param JsonFactory $jsonFactory
     * @param DataObjectHelper $dataObjectHelper
     */
    public function __construct(
        Context $context,
        CommentRepository $commentRepository,
        JsonFactory $jsonFactory,
        DataObjectHelper $dataObjectHelper
    ) {
        parent::__construct($context);
        $this->commentRepository = $commentRepository;
        $this->jsonFactory = $jsonFactory;
        $this->dataObjectHelper = $dataObjectHelper;
    }

    /**
     * Executes
     *
     * @return mixed
     */
    public function execute()
    {
        /** @var \Magento\Framework\Controller\Result\Json $resultJson */
        $resultJson = $this->jsonFactory->create();
        $error = false;
        $messages = [];

        if ($this->getRequest()->getParam('isAjax')) {
            $postItems = $this->getRequest()->getParam('items', []);
            if (!count($postItems)) {
                $messages[] = __('Please correct the data sent.');
                $error = true;
            } else {
                foreach (array_keys($postItems) as $commentId) {
                    /** @var \Mavenbird\PredefinedAdminOrderComments\Model\Comment $comment */
                    $comment = $this->commentRepository->getById($commentId);
                    try {
                        $this->dataObjectHelper->populateWithArray(
                            $comment,
                            $postItems[$commentId],
                            CommentInterface::class
                        );

                        $this->commentRepository->save($comment);
                    } catch (\Exception $e) {
                        $messages[] = $this->getErrorWithCommentId(
                            $comment,
                            __($e->getMessage())
                        );
                        $error = true;
                    }
                }
            }
        }

        return $resultJson->setData([
            'messages' => $messages,
            'error' => $error
        ]);
    }

    /**
     * Add comment title to error message
     *
     * @param CommentRepository $comment
     * @param string $errorText
     * @return string
     */
    protected function getErrorWithCommentId(CommentRepository $comment, $errorText)
    {
        return '[Comment ID: ' . $comment->getCommentId() . '] ' . $errorText;
    }
}
