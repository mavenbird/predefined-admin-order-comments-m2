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
namespace Mavenbird\PredefinedAdminOrderComments\Block\Adminhtml\Comment\Edit;

use Magento\Backend\Block\Widget\Context;
use Mavenbird\PredefinedAdminOrderComments\Api\CommentRepositoryInterface;
use Magento\Framework\Exception\NoSuchEntityException;

class GenericButton
{
    /**
     * @var Context
     */
    protected $context;

    /**
     * @var CommentRepositoryInterface
     */
    protected $commentRepository;

    /**
     * @param Context $context
     * @param CommentRepositoryInterface $commentRepository
     */
    public function __construct(
        Context $context,
        CommentRepositoryInterface $commentRepository
    ) {
        $this->context = $context;
        $this->commentRepository = $commentRepository;
    }

    /**
     * Get Comment Ids
     *
     * @return int|null
     */
    public function getCommentId()
    {
        try {
            return $this->commentRepository->getById(
                $this->context->getRequest()->getParam('comment_id')
            )->getCommentId();
        } catch (NoSuchEntityException $e) {
            return null;
        }
        return null;
    }

    /**
     * Generate url by route and parameters
     *
     * @param   string $route
     * @param   array $params
     * @return  string
     */
    public function getUrl($route = '', $params = [])
    {
        return $this->context->getUrlBuilder()->getUrl($route, $params);
    }
}
