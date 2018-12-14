<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Meritos Model
 *
 * @property \App\Model\Table\ConvocatoriasTable|\Cake\ORM\Association\BelongsTo $Convocatorias
 * @property \App\Model\Table\CategoriasTable|\Cake\ORM\Association\BelongsTo $Categorias
 * @property |\Cake\ORM\Association\BelongsTo $TiposMeritos
 * @property |\Cake\ORM\Association\HasMany $SolicitudHasMeritos
 *
 * @method \App\Model\Entity\Merito get($primaryKey, $options = [])
 * @method \App\Model\Entity\Merito newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Merito[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Merito|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Merito patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Merito[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Merito findOrCreate($search, callable $callback = null, $options = [])
 */
class MeritosTable extends Table
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

        $this->setTable('meritos');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Convocatorias', [
            'foreignKey' => 'convocatoria_id'
        ]);
        $this->belongsTo('Categorias', [
            'foreignKey' => 'categoria_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('TiposMeritos', [
            'foreignKey' => 'tipos_meritos_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('SolicitudHasMeritos', [
            'foreignKey' => 'merito_id'
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
            ->scalar('Puntuacion')
            ->maxLength('Puntuacion', 10)
            //->requirePresence('Puntuacion', 'create')
            ->allowEmpty('Puntuacion')
            ->add('Puntuacion', [
				'numeric' => [
					'rule' => ['numeric'],
					'message' => 'Solo se admiten digitos numéricos.'
				]
			]);
            
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
        $rules->add($rules->existsIn(['categoria_id'], 'Categorias'));
        $rules->add($rules->existsIn(['tipos_meritos_id'], 'TiposMeritos'));

        return $rules;
    }
}
