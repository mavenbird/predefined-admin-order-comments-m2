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
namespace Mavenbird\PredefinedAdminOrderComments\Api\Data;

/**
 * Predefined Admin Order Comments interface
 * @api
 */
interface CommentInterface
{
    /**#@+
     * Constants for keys of data array. Identical to the name of the getter in snake case
     */
    public const COMMENT_ID     = 'comment_id';
    public const TITLE          = 'title';
    public const CONTENT        = 'content';
    public const CREATION_TIME  = 'creation_time';
    public const UPDATE_TIME    = 'update_time';
    public const IS_ACTIVE      = 'is_active';
    /**#@-*/

    /**
     * Get Comment ID
     *
     * @return int|null
     */
    public function getCommentId();

    /**
     * Get title
     *
     * @return string|null
     */
    public function getTitle();

    /**
     * Get content
     *
     * @return string|null
     */
    public function getContent();

    /**
     * Get creation time
     *
     * @return string|null
     */
    public function getCreationTime();

    /**
     * Get update time
     *
     * @return string|null
     */
    public function getUpdateTime();

    /**
     * Get Is active
     *
     * @return bool|null
     */
    public function getIsActive();

    /**
     * Set Comment ID
     *
     * @param int $id
     * @return CommentInterface
     */
    public function setCommentId($id);

    /**
     * Set title
     *
     * @param string $title
     * @return CommentInterface
     */
    public function setTitle($title);

    /**
     * Set comment
     *
     * @param string $content
     * @return CommentInterface
     */
    public function setContent($content);

    /**
     * Set creation time
     *
     * @param string $creationTime
     * @return CommentInterface
     */
    public function setCreationTime($creationTime);

    /**
     * Set update time
     *
     * @param string $updateTime
     * @return CommentInterface
     */
    public function setUpdateTime($updateTime);

    /**
     * Set is active
     *
     * @param bool|int $isActive
     * @return CommentInterface
     */
    public function setIsActive($isActive);
}
