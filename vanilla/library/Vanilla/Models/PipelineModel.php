<?php
/**
 * @copyright 2009-2019 Vanilla Forums Inc.
 * @license GPL-2.0-only
 */

namespace Vanilla\Models;

use Exception;
use Garden\Schema\Schema;
use Vanilla\Database\Operation;
use Vanilla\Database\Operation\Pipeline;
use Vanilla\Database\Operation\Processor;
use Vanilla\InjectableInterface;

/**
 * Basic model class with database operation pipeline support.
 */
class PipelineModel extends Model implements InjectableInterface {

    /** @var Pipeline */
    protected $pipeline;

    /**
     * Model constructor.
     *
     * @param string $table Database table associated with this resource.
     */
    public function __construct(string $table) {
        parent::__construct($table);
        $this->pipeline = new Pipeline();
    }

    /**
     * Add a database operations processor to the pipeline.
     *
     * @param Processor $processor
     */
    public function addPipelineProcessor(Processor $processor) {
        $this->pipeline->addProcessor($processor);
    }

    /**
     * Get resource rows from a database table.
     *
     * @param array $where Conditions for the select query.
     * @param array $options Options for the select query.
     *    - orderFields (string, array): Fields to sort the result by.
     *    - orderDirection (string): Sort direction for the order fields.
     *    - limit (int): Limit on the total results returned.
     *    - offset (int): Row offset before capturing the result.
     * @return array Rows matching the conditions and within the parameters specified in the options.
     */
    public function get(array $where = [], array $options = []): array {
        $databaseOperation = new Operation();
        $databaseOperation->setType(Operation::TYPE_SELECT);
        $databaseOperation->setCaller($this);
        $databaseOperation->setWhere($where);
        $databaseOperation->setOptions($options);
        $result = $this->pipeline->process($databaseOperation, function (Operation $databaseOperation) {
            return parent::get(
                $databaseOperation->getWhere(),
                $databaseOperation->getOptions()
            );
        });
        return $result;
    }

    /**
     * Get the model's read schema.
     *
     * @return Schema
     */
    public function getReadSchema(): Schema {
        $this->ensureSchemas();
        return $this->readSchema;
    }

    /**
     * Get the model's write schema.
     *
     * @return Schema
     */
    public function getWriteSchema(): Schema {
        $this->ensureSchemas();
        return $this->writeSchema;
    }

    /**
     * Add a resource row.
     *
     * @param array $set Field values to set.
     * @return mixed ID of the inserted row.
     * @throws Exception If an error is encountered while performing the query.
     */
    public function insert(array $set) {
        $databaseOperation = new Operation();
        $databaseOperation->setType(Operation::TYPE_INSERT);
        $databaseOperation->setCaller($this);
        $databaseOperation->setSet($set);
        $result = $this->pipeline->process($databaseOperation, function (Operation $databaseOperation) {
            return parent::insert($databaseOperation->getSet());
        });
        return $result;
    }

    /**
     * Update existing resource rows.
     *
     * @param array $set Field values to set.
     * @param array $where Conditions to restrict the update.
     * @throws Exception If an error is encountered while performing the query.
     * @return bool True.
     */
    public function update(array $set, array $where): bool {
        $databaseOperation = new Operation();
        $databaseOperation->setType(Operation::TYPE_UPDATE);
        $databaseOperation->setCaller($this);
        $databaseOperation->setSet($set);
        $databaseOperation->setWhere($where);
        $result = $this->pipeline->process($databaseOperation, function (Operation $databaseOperation) {
            return parent::update(
                $databaseOperation->getSet(),
                $databaseOperation->getWhere()
            );
        });
        return $result;
    }
}
