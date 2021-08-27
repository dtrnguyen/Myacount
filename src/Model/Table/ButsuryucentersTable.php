<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Butsuryucenters Model
 *
 * @method \App\Model\Entity\Butsuryucenter newEmptyEntity()
 * @method \App\Model\Entity\Butsuryucenter newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Butsuryucenter[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Butsuryucenter get($primaryKey, $options = [])
 * @method \App\Model\Entity\Butsuryucenter findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Butsuryucenter patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Butsuryucenter[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Butsuryucenter|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Butsuryucenter saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Butsuryucenter[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Butsuryucenter[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Butsuryucenter[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Butsuryucenter[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class ButsuryucentersTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('butsuryucenters');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('shouhinID')
            // ->maxLength('shouhinID', 225)
            // ->requirePresence('shouhinID')
            ->allowEmptyString('shouhinID');

        $validator
            ->scalar('companyname')
            // ->maxLength('companyname', 225)
            // ->requirePresence('companyname')
            ->notEmptyString('companyname');

        $validator
            ->scalar('companytel')
            // ->maxLength('companytel', 225)
            // ->requirePresence('companytel')
            ->notEmptyString('companytel');

        $validator
            ->scalar('companyaddress')
            // ->maxLength('companyaddress', 225)
            // ->requirePresence('companyaddress')
            ->notEmptyString('companyaddress');

        $validator
            ->scalar('tenponame')
            // ->maxLength('tenponame', 225)
            // ->requirePresence('tenponame')
            ->notEmptyString('tenponame');

        $validator
            ->scalar('tenpotel')
            // ->maxLength('tenpotel', 225)
            // ->requirePresence('tenpotel')
            ->notEmptyString('tenpotel');

        $validator
            ->scalar('tenpoaddress')
            // ->maxLength('tenpoaddress', 225)
            // ->requirePresence('tenpoaddress')
            ->notEmptyString('tenpoaddress');

        $validator
            ->scalar('shohinmei')
            // ->maxLength('shohinmei', 225)
            // ->requirePresence('shohinmei')
            ->allowEmptyString('shohinmei');

        $validator
            ->scalar('shurui')
            // ->maxLength('shurui', 225)
            // ->requirePresence('shurui')
            ->allowEmptyString('shurui');

        $validator
            ->scalar('kakaku')
            // ->maxLength('kakaku', 225)
            // ->requirePresence('kakaku')
            ->allowEmptyString('kakaku');

        $validator
            ->scalar('unchintoraku')
            // ->maxLength('unchintoraku', 225)
            // ->requirePresence('unchintoraku')
            ->allowEmptyString('unchintoraku');

        $validator
            ->scalar('tantosha')
            // ->maxLength('tantosha', 225)
            // ->requirePresence('tantosha')
            ->allowEmptyString('tantosha');

        $validator
            ->date('nyukoubi')
            // ->maxLength('nyukoubi', 225)
            // ->requirePresence('nyukoubi')
            ->allowEmptyString('nyukoubi');

        $validator
            ->date('shukoubi')
            ->maxLength('shukoubi', 225)
            ->requirePresence('shukoubi')
            ->allowEmptyString('shukoubi');

        return $validator;
    }
}
