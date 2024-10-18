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
namespace Mavenbird\PredefinedAdminOrderComments\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

/**
 * Predefined Admin Order Comments CRUD interface.
 * @api
 */
interface CommentRepositoryInterface
{
    /**
     * Save a predefined comment.
     *
     * @param  \Mavenbird\PredefinedAdminOrderComments\Api\Data\CommentInterface $comment
     * @return \Mavenbird\PredefinedAdminOrderComments\Api\Data\CommentInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(Data\CommentInterface $comment);

    /**
     * Retrieve a predefined comment
     *
     * @param int $commentId
     * @return \Mavenbird\PredefinedAdminOrderComments\Api\Data\CommentInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($commentId);

    /**
     * Retrieve predefined comments matching the specified criteria.
     *
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Mavenbird\PredefinedAdminOrderComments\Api\Data\CommentSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);

    /**
     * Delete a predefined comment.
     *
     * @param \Mavenbird\PredefinedAdminOrderComments\Api\Data\CommentInterface $comment
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(Data\CommentInterface $comment);

    /**
     * Delete a predefined comment by ID.
     *
     * @param int $commentId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($commentId);
}
