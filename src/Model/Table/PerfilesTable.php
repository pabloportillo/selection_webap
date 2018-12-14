<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Perfiles Model
 *
 * @method \App\Model\Entity\Perfile get($primaryKey, $options = [])
 * @method \App\Model\Entity\Perfile newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Perfile[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Perfile|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Perfile patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Perfile[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Perfile findOrCreate($search, callable $callback = null, $options = [])
 */
class PerfilesTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('perfiles');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->scalar('Nombre')
            ->maxLength('Nombre', 60)
            ->requirePresence('Nombre', 'create')
            ->notEmpty('Nombre')
            ->add('Nombre', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->isUnique(['Nombre']));

        return $rules;
    }
}
