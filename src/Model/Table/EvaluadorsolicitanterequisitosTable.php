<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Evaluadorsolicitanterequisitos Model
 *
 * @property \App\Model\Table\UsuariosTable|\Cake\ORM\Association\BelongsTo $Usuarios
 * @property \App\Model\Table\RequisitosTable|\Cake\ORM\Association\BelongsTo $Requisitos
 * @property \App\Model\Table\UsuariosTable|\Cake\ORM\Association\BelongsTo $Usuarios
 *
 * @method \App\Model\Entity\Evaluadorsolicitanterequisito get($primaryKey, $options = [])
 * @method \App\Model\Entity\Evaluadorsolicitanterequisito newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Evaluadorsolicitanterequisito[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Evaluadorsolicitanterequisito|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Evaluadorsolicitanterequisito patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Evaluadorsolicitanterequisito[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Evaluadorsolicitanterequisito findOrCreate($search, callable $callback = null, $options = [])
 */
class EvaluadorsolicitanterequisitosTable extends Table
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

        $this->setTable('evaluadorsolicitanterequisitos');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Usuarios', [
            'foreignKey' => 'Usuario_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Requisitos', [
            'foreignKey' => 'Requisito_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Usuarios', [
            'foreignKey' => 'solicitante_id'
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
            ->scalar('DescripcionEvaluacion')
            ->maxLength('DescripcionEvaluacion', 100)
            ->allowEmpty('DescripcionEvaluacion');

        $validator
            ->boolean('Validado')
            ->requirePresence('Validado', 'create')
            ->notEmpty('Validado');

        $validator
            ->date('FechaCreacion')
            ->requirePresence('FechaCreacion', 'create')
            ->notEmpty('FechaCreacion');

        $validator
            ->date('FechaEvaluacion')
            ->allowEmpty('FechaEvaluacion');

        $validator
            ->boolean('Reclamacion')
            ->requirePresence('Reclamacion', 'create')
            ->notEmpty('Reclamacion');

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
        $rules->add($rules->existsIn(['Usuario_id'], 'Usuarios'));
        $rules->add($rules->existsIn(['Requisito_id'], 'Requisitos'));
        $rules->add($rules->existsIn(['solicitante_id'], 'Usuarios'));

        return $rules;
    }
}
