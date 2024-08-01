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

use Magento\Framework\Api\SearchResultsInterface;

/**
 * Interface for Predefined Admin Order Comments search results.
 * @api
 */
interface CommentSearchResultsInterface extends SearchResultsInterface
{
    /**
     * Get predefined comments list.
     *
     * @return \Mavenbird\PredefinedAdminOrderComments\Api\Data\CommentInterface[]
     */
    public function getItems();

    /**
     * Set a predefined comments list.
     *
     * @param \Mavenbird\PredefinedAdminOrderComments\Api\Data\CommentInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
