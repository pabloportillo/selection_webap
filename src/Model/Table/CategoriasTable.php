<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Categorias Model
 *
 * @property \App\Model\Table\ConvocatoriasTable|\Cake\ORM\Association\BelongsTo $Convocatorias
 * @property \App\Model\Table\MeritosTable|\Cake\ORM\Association\HasMany $Meritos
 *
 * @method \App\Model\Entity\Categoria get($primaryKey, $options = [])
 * @method \App\Model\Entity\Categoria newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Categoria[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Categoria|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Categoria patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Categoria[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Categoria findOrCreate($search, callable $callback = null, $options = [])
 */
class CategoriasTable extends Table
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

        $this->setTable('categorias');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Convocatorias', [
            'foreignKey' => 'convocatoria_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('Meritos', [
            'foreignKey' => 'categoria_id'
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
            ->scalar('PuntuacionMax')
            ->maxLength('PuntuacionMax', 10)
            ->requirePresence('PuntuacionMax', 'create')
            ->notEmpty('PuntuacionMax')
			->add('PuntuacionMax', [
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

        return $rules;
    }
}
