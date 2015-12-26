<?php


namespace Coolsurfin\Integration\Api\V1\Storage;


use DateTime;
use DateTimeZone;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\SchemaTool;
use JeremyGiberson\Coolsurfin\Api\V1\Doctrine\EntityManagerFactory;
use JeremyGiberson\Coolsurfin\Api\V1\Model\Post;
use JeremyGiberson\Coolsurfin\Api\V1\Storage\PostStorage;
use JeremyGiberson\Coolsurfin\Api\V1\Storage\PostStorageInterface;
use PHPUnit_Extensions_Database_DataSet_IDataSet;
use PHPUnit_Extensions_Database_DB_IDatabaseConnection;

class PostStorageTest extends \PHPUnit_Extensions_Database_TestCase
{
    /** @var  EntityManager */
    protected static $entity_manager;
    /** @var  SchemaTool */
    protected static $schema_tool;
    /** @var  PostStorageInterface */
    protected $storage;

    /**
     * This method is called before the first test of this test class is run.
     *
     * @since Method available since Release 3.4.0
     */
    public static function setUpBeforeClass()
    {
        $factory = new EntityManagerFactory(['driver' => 'pdo_sqlite', 'memory' => true]);
        self::$entity_manager = $factory->create(true);
        self::$entity_manager->clear();

        self::$schema_tool = new SchemaTool(self::$entity_manager);
        self::$schema_tool->createSchema(self::$entity_manager->getMetadataFactory()->getAllMetadata());
    }

    /**
     * This method is called after the last test of this test class is run.
     *
     * @since Method available since Release 3.4.0
     */
    public static function tearDownAfterClass()
    {
        self::$schema_tool->dropDatabase();
    }

    /**
     * Performs operation returned by getSetUpOperation().
     */
    protected function setUp()
    {
        $this->storage = new PostStorage(self::$entity_manager);

        parent::setUp();
    }


    /**
     * Returns the test database connection.
     *
     * @return PHPUnit_Extensions_Database_DB_IDatabaseConnection
     */
    protected function getConnection()
    {
        $pdo = self::$entity_manager->getConnection()->getWrappedConnection();
        return $this->createDefaultDBConnection($pdo, ':memory:');
    }

    /**
     * Returns the test dataset.
     *
     * @return PHPUnit_Extensions_Database_DataSet_IDataSet
     */
    protected function getDataSet()
    {
        return $this->createFlatXMLDataSet(__DIR__ . '/fixtures/default_data.xml');
    }

    public function test_it_persists_model(){
        $post = new Post();
        $post->setAuthor('joe');
        $post->setContent('hello world');
        $post->setCreated(new DateTime('2010-04-24 17:15:23', new DateTimeZone('UTC')));
        $this->storage->save($post);
        $this->assertNotEmpty($post->getId());

        $queryTable = $this->getConnection()->createQueryTable(
            'posts', 'SELECT id, author, content, created FROM posts'
        );
        $expectedTable = $this->createFlatXMLDataSet(__DIR__ . '/fixtures/persisted_post.xml')
            ->getTable("posts");
        $this->assertTablesEqual($expectedTable, $queryTable);
    }
}
