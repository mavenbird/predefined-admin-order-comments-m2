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
namespace Mavenbird\PredefinedAdminOrderComments\Model;

use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\CouldNotSaveException;
use Mavenbird\PredefinedAdminOrderComments\Model\ResourceModel\Comment as ResourceComment;
use Mavenbird\PredefinedAdminOrderComments\Model\ResourceModel\Comment\CollectionFactory as CommentCollectionFactory;
use Mavenbird\PredefinedAdminOrderComments\Api\CommentRepositoryInterface;
use Mavenbird\PredefinedAdminOrderComments\Api\Data\CommentInterface;
use Mavenbird\PredefinedAdminOrderComments\Api\Data\CommentInterfaceFactory;
use Mavenbird\PredefinedAdminOrderComments\Api\Data\CommentSearchResultsInterfaceFactory;

class CommentRepository implements CommentRepositoryInterface
{
    /**
     * @var ResourceComment
     */
    protected $resource;

    /**
     * @var CommentFactory
     */
    protected $commentFactory;

    /**
     * @var CommentCollectionFactory
     */
    protected $commentCollectionFactory;

    /**
     * @var CommentSearchResultsInterfaceFactory
     */
    protected $searchResultsFactory;

    /**
     * @var CommentInterfaceFactory
     */
    protected $commentDataFactory;

    /**
     * @param ResourceComment $resource
     * @param CommentFactory $commentFactory
     * @param CommentCollectionFactory $commentCollectionFactory
     * @param CommentInterfaceFactory $commentDataFactory
     * @param CommentSearchResultsInterfaceFactory $searchResultsFactory
     */
    public function __construct(
        ResourceComment $resource,
        CommentFactory $commentFactory,
        CommentCollectionFactory $commentCollectionFactory,
        CommentInterfaceFactory $commentDataFactory,
        CommentSearchResultsInterfaceFactory $searchResultsFactory
    ) {
        $this->resource = $resource;
        $this->commentFactory = $commentFactory;
        $this->commentCollectionFactory = $commentCollectionFactory;
        $this->commentDataFactory = $commentDataFactory;
        $this->searchResultsFactory = $searchResultsFactory;
    }

    /**
     * Save Comment data
     *
     * @param CommentInterface $comment
     * @return object
     * @throws CouldNotSaveException
     */
    public function save(CommentInterface $comment)
    {
        try {
            $this->resource->save($comment);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__($exception->getMessage()));
        }
        return $comment;
    }

    /**
     * Load Comment data by given Comment Id
     *
     * @param string $commentId
     * @return object
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getById($commentId)
    {
        $comment = $this->commentFactory->create();
        $this->resource->load($comment, $commentId);
        if (!$comment->getId()) {
            throw new NoSuchEntityException(__('Comment with id "%1" does not exist.', $commentId));
        }
        return $comment;
    }

    /**
     * Load Comment data collection by given search criteria
     *
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     * @param \Magento\Framework\Api\SearchCriteriaInterface $criteria
     * @return \Mavenbird\PredefinedAdminOrderComments\Api\Data\CommentSearchResultsInterface
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $criteria)
    {
        /** @var \Mavenbird\PredefinedAdminOrderComments\Model\ResourceModel\Comment\Collection $collection */
        $collection = $this->commentCollectionFactory->create();

        /** @var CommentSearchResultsInterface $searchResults */
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }

    /**
     * Delete Comment
     *
     * @param CommentInterface $comment
     * @return bool
     * @throws CouldNotDeleteException
     */
    public function delete(CommentInterface $comment)
    {
        try {
            $this->resource->delete($comment);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__($exception->getMessage()));
        }
        return true;
    }

    /**
     * Delete Comment by given Comment Id
     *
     * @param integer $commentId
     * @return bool
     * @throws CouldNotDeleteException
     * @throws NoSuchEntityException
     */
    public function deleteById($commentId)
    {
        return $this->delete($this->getById($commentId));
    }
}
