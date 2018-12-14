<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Archivossubidos Model
 *
 * @property \App\Model\Table\ConvocatoriasTable|\Cake\ORM\Association\BelongsTo $Convocatorias
 *
 * @method \App\Model\Entity\Archivossubido get($primaryKey, $options = [])
 * @method \App\Model\Entity\Archivossubido newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Archivossubido[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Archivossubido|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Archivossubido patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Archivossubido[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Archivossubido findOrCreate($search, callable $callback = null, $options = [])
 */
class ArchivossubidosTable extends Table
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

        $this->setTable('archivossubidos');
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
            ->maxLength('Descripcion', 100)
            ->requirePresence('Descripcion', 'create')
            ->notEmpty('Descripcion');

        $validator
            ->scalar('Archivo')
            ->maxLength('Archivo', 100)
            ->requirePresence('Archivo', 'create')
            ->notEmpty('Archivo');

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
