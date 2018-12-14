<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Requisitos Model
 *
 * @property \App\Model\Table\ConvocatoriasTable|\Cake\ORM\Association\BelongsTo $Convocatorias
 *
 * @method \App\Model\Entity\Requisito get($primaryKey, $options = [])
 * @method \App\Model\Entity\Requisito newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Requisito[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Requisito|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Requisito patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Requisito[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Requisito findOrCreate($search, callable $callback = null, $options = [])
 */
class RequisitosTable extends Table
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

        $this->setTable('requisitos');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Convocatorias', [
            'foreignKey' => 'convocatoria_id',
            'joinType' => 'INNER'
        ]);
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
            ->scalar('Descripcion')
            ->maxLength('Descripcion', 255)
            ->requirePresence('Descripcion', 'create')
            ->notEmpty('Descripcion');

        $validator
            ->scalar('motivo_exclusion')
            ->maxLength('motivo_exclusion', 255)
            ->requirePresence('motivo_exclusion', 'create')
            ->notEmpty('motivo_exclusion');         

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
        $rules->add($rules->existsIn(['convocatoria_id'], 'Convocatorias'));

        return $rules;
    }
}
