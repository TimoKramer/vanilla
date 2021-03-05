<?php
/**
 * @author Alexander Kim <alexander.k@vanillaforums.com>
 * @copyright 2009-2019 Vanilla Forums Inc.
 * @license GPL-2.0-only
 */

namespace Vanilla\Contracts\Search;

/**
 * Interface SearchRecordTypeProviderInterface
 * @package Vanilla\Contracts\Search
 */
interface SearchRecordTypeProviderInterface {
    /**
     * Get all supported search record types
     * @return array
     */
    public function getAll(): array;

    /**
     * Set/add search record type
     *
     * @param SearchRecordTypeInterface $recordType
     * @return array
     */
    public function setType(SearchRecordTypeInterface $recordType);

    /**
     * Get search record type by typeKey
     *
     * @param string $typeKey
     * @return null|SearchRecordTypeInterface
     */
    public function getType(string $typeKey): ?SearchRecordTypeInterface;

    /**
     * Get search record type by sphinx dtype value
     *
     * @param int $dtype
     * @return null|SearchRecordTypeInterface
     */
    public function getByDType(int $dtype): ?SearchRecordTypeInterface;

    /**
     * Add (activate) search provider group. Ex: advanced, sphinx, etc...
     *
     * @param string $providerGroup
     */
    public function addProviderGroup(string $providerGroup);
}
