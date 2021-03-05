<?php
/**
 * @author Alexandre (DaazKu) Chouinard <alexandre.c@vanillaforums.com>
 * @copyright 2009-2019 Vanilla Forums Inc.
 * @license GPL-2.0-only
 */

namespace Vanilla\Utility;

use Garden\Schema\Validation;
use Garden\Schema\ValidationException;
use Gdn_Locale as LocaleInterface;
use Gdn_Validation;

/**
 * Class ModelUtils.
 */
class ModelUtils {

    /**
     * Convert a Garden Schema validation exception into a Gdn_Validation instance.
     *
     * @param ValidationException $exception
     */
    public static function validationExceptionToValidationResult(ValidationException $exception): Gdn_Validation {
        $result = new Gdn_Validation();
        $errors = $exception->getValidation()->getErrors();

        foreach ($errors as $error) {
            $fieldName = $error["field"] ?? null;
            $message = $error["message"] ?? null;
            if ($fieldName && $message) {
                $errorCode = str_replace($fieldName, "%s", $message);
                $result->addValidationResult($fieldName, $errorCode);
            }
        }

        return $result;
    }

    /**
     * Given a model (old Gdn_Model mainly), analyze its validation property and return failures.
     *
     * @param object $model The model to analyze the Validation property of.
     * @param LocaleInterface $locale
     * @param bool $throw If errors are found, should an exception be thrown?
     *
     * @return Validation
     * @throws \Garden\Schema\ValidationException
     */
    public static function validationResultToValidationException($model, LocaleInterface $locale, $throw = true) {
        $validation = new Validation();
        $caseScheme = new CamelCaseScheme();

        if (property_exists($model, 'Validation') && $model->Validation instanceof Gdn_Validation) {
            $results = $model->Validation->results();
            $results = $caseScheme->convertArrayKeys($results);
            foreach ($results as $field => $errors) {
                foreach ($errors as $error) {
                    $message = trim(sprintf(
                        $locale->translate($error),
                        $locale->translate($field)
                    ), '.').'.';
                    $validation->addError(
                        $field,
                        $error,
                        ['message' => $message]
                    );
                }
            }
        }

        if ($throw && $validation->getErrorCount() > 0 ) {
            throw new ValidationException($validation);
        }

        return $validation;
    }
}
