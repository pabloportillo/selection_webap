<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * SolicitudHasMeritos Model
 *
 * @property \App\Model\Table\SolicitudesTable|\Cake\ORM\Association\BelongsTo $Solicitudes
 * @property \App\Model\Table\MeritosTable|\Cake\ORM\Association\BelongsTo $Meritos
 *
 * @method \App\Model\Entity\SolicitudHasMerito get($primaryKey, $options = [])
 * @method \App\Model\Entity\SolicitudHasMerito newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\SolicitudHasMerito[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\SolicitudHasMerito|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SolicitudHasMerito patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\SolicitudHasMerito[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\SolicitudHasMerito findOrCreate($search, callable $callback = null, $options = [])
 */
class SolicitudHasMeritosTable extends Table
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

        $this->setTable('solicitud_has_meritos');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Solicitudes', [
            'foreignKey' => 'solicitude_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Meritos', [
            'foreignKey' => 'merito_id',
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
        
        $validator
            ->scalar('puntuacion')
            ->allowEmpty('puntuacion');             

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
        $rules->add($rules->existsIn(['merito_id'], 'Meritos'));

        return $rules;
    }
}
