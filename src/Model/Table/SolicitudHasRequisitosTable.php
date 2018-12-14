<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * SolicitudHasRequisitos Model
 *
 * @property \App\Model\Table\SolicitudesTable|\Cake\ORM\Association\BelongsTo $Solicitudes
 * @property \App\Model\Table\RequisitosTable|\Cake\ORM\Association\BelongsTo $Requisitos
 *
 * @method \App\Model\Entity\SolicitudHasRequisito get($primaryKey, $options = [])
 * @method \App\Model\Entity\SolicitudHasRequisito newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\SolicitudHasRequisito[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\SolicitudHasRequisito|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SolicitudHasRequisito patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\SolicitudHasRequisito[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\SolicitudHasRequisito findOrCreate($search, callable $callback = null, $options = [])
 */
class SolicitudHasRequisitosTable extends Table
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

        $this->setTable('solicitud_has_requisitos');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Solicitudes', [
            'foreignKey' => 'solicitude_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Requisitos', [
            'foreignKey' => 'requisito_id',
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
            //->boolean('valido')
            ->requirePresence('valido', 'create')
            ->notEmpty('valido');

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
        $rules->add($rules->existsIn(['solicitude_id'], 'Solicitudes'));
        $rules->add($rules->existsIn(['requisito_id'], 'Requisitos'));

        return $rules;
    }
}