<?php
/**
 * @copyright 2009-2019 Vanilla Forums Inc.
 * @license GPL-2.0-only
 */

namespace Vanilla;

class FileUtils {

    /**
     * Check if a file was uploaded in the current request.
     *
     * @param $filename
     * @return bool
     */
    function isUploadedFile($filename) {
        $result = is_uploaded_file($filename);
        return $result;
    }

    /**
     * Move an upload to a new location.
     *
     * @param $filename
     * @param $destination
     * @return bool
     */
    function moveUploadedFile($filename, $destination) {
        $result = move_uploaded_file($filename, $destination);
        return $result;
    }
}
