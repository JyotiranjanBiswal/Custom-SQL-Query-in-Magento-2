<?php
/**
 * @Module         : Jrb Demomodule
 * @Package        : Jrb_Demomodule
 * @Description    : Testing custom script output
 * @Developer      : Jyotiranjan Biswal<biswal@jyotiranjan.in>
 * @Copyright      : https://www.jyotiranjan.in/
 */

namespace Jrb\DemoModule\Model;

use Magento\Framework\Model\AbstractModel;
use Magento\Framework\App\ResourceConnection;

class CustomScript extends AbstractModel
{

    protected $logger;

    /**
     * Resource
     *
     * @var ResourceConnection
     */
    protected $resourceConnection;

    /**
     * Constructor
     *
     * @param \Psr\Log\LoggerInterface $logger
     */
    public function __construct(
        \Psr\Log\LoggerInterface $logger,
        ResourceConnection $resourceConnection,
    )
    {
        $this->logger = $logger;
        $this->resourceConnection = $resourceConnection;
    }

    /**
     * Execute the custom script
     *
     * @return void
     */
    public function execute()
    {
        // get the list of record having store id 1
        $storeId = 1;
        $customerData = $this->getAllRecords($storeId);
        print_r($customerData);

        // update customer data
        $customerId = 2;
        $data = ['firstname' => 'Jyoti', 'lastname' => 'Mishra', 'is_active' => 0];
        $this->updateRecordById($customerId,$data);
        
        // delete customer data by id 
        $customerId = 3;
        $this->deleteRecordById($customerId);

        $this->logger->info('customer_data',$customerData);
    }

    /**
     * @param int $id
     * 
     * @return array
     */
    public function getAllRecords($id){
        $connection = $this->resourceConnection->getConnection();
        $tableName = $this->resourceConnection->getTableName('customer_entity');

        $bind = ['store_id' => $id];
        $query = $connection
            ->select()
            ->from(
                ['main_table' => $tableName],
                ['entity_id','email','firstname']
            )
            ->where('store_id = :store_id');

        return $connection->fetchAll($query, $bind);
    }

    /**
     * @param int $id
     * @param array $data
     * 
     * @return void
     */
    public function updateRecordById($id, $data){
        $connection = $this->resourceConnection->getConnection();
        $tableName = $this->resourceConnection->getTableName('customer_entity');
        $condition = $connection->quoteInto('entity_id = ?', $id);
        $connection->update(
            $tableName,
            $data,
            $condition
        );
    }

    /**
     * @param int $id
     * 
     * @return void
     */
    public function deleteRecordById($id){
        $connection = $this->resourceConnection->getConnection();
        $tableName = $this->resourceConnection->getTableName('customer_entity');
        $condition = $connection->quoteInto('entity_id = ?', $id);
        $connection->delete(
            $tableName,
            $condition
        );
    }


}