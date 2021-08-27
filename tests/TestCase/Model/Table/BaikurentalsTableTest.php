<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\BaikurentalsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\BaikurentalsTable Test Case
 */
class BaikurentalsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\BaikurentalsTable
     */
    protected $Baikurentals;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Baikurentals',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Baikurentals') ? [] : ['className' => BaikurentalsTable::class];
        $this->Baikurentals = $this->getTableLocator()->get('Baikurentals', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Baikurentals);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
