<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Convocatorias Model
 *
 * @property \App\Model\Table\UsuariosTable|\Cake\ORM\Association\BelongsTo $Usuarios
 * @property \App\Model\Table\ArchivossubidosTable|\Cake\ORM\Association\HasMany $Archivossubidos
 * @property \App\Model\Table\CategoriasTable|\Cake\ORM\Association\HasMany $Categorias
 * @property \App\Model\Table\ExclusionMotivosTable|\Cake\ORM\Association\HasMany $ExclusionMotivos
 * @property \App\Model\Table\MeritosTable|\Cake\ORM\Association\HasMany $Meritos
 * @property \App\Model\Table\RequisitosTable|\Cake\ORM\Association\HasMany $Requisitos
 * @property \App\Model\Table\SolicitudesTable|\Cake\ORM\Association\HasMany $Solicitudes
 *
 * @method \App\Model\Entity\Convocatoria get($primaryKey, $options = [])
 * @method \App\Model\Entity\Convocatoria newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Convocatoria[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Convocatoria|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Convocatoria patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Convocatoria[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Convocatoria findOrCreate($search, callable $callback = null, $options = [])
 */
class ConvocatoriasTable extends Table
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

        $this->setTable('convocatorias');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
        
        // add Duplicatable behavior
        $this->addBehavior('Duplicatable.Duplicatable', [
            // table finder
            'finder' => 'all',
            // duplicate also items and their properties
            'contain' => ['Categorias', 'Meritos', 'Requisitos'],
            // remove id field from both Convocatoria and items
            /*'remove' => ['id', 'convocatoria_items.id'],*/
            // mark convocatoria as copied
            /*
            'set' => [
                'name' => function($entity) {
                    return md5($entity->name) . ' ' . $entity->name;
                },
                'copied' => true
            ],
            */
            // prepend properties name
            /*'prepend' => ['convocatoria_items.convocatoria_items_properties.name' => 'NEW '], */
            // append copy to the name
            'append' => ['Nombre' => ' - Copia']
        ]);        

        $this->belongsTo('Usuarios', [
            'foreignKey' => 'Usuario_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('Archivossubidos', [
            'foreignKey' => 'convocatoria_id'
        ]);
        $this->hasMany('Categorias', [
            'foreignKey' => 'convocatoria_id'
        ]);
        $this->hasMany('Meritos', [
            'foreignKey' => 'convocatoria_id'
        ]);
        $this->hasMany('Requisitos', [
            'foreignKey' => 'convocatoria_id'
        ]);
        $this->hasMany('Solicitudes', [
            'foreignKey' => 'convocatoria_id'
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
            ->scalar('Nombre')
            ->maxLength('Nombre', 100)
            ->requirePresence('Nombre', 'create')
            ->notEmpty('Nombre');

        $validator
            ->scalar('Descripcion')
            ->maxLength('Descripcion', 3550);
            //->requirePresence('Descripcion', 'create')
            //->notEmpty('Descripcion');

      /*$validator
            ->date('FechaCreacion')
            ->requirePresence('FechaCreacion', 'create')
            ->notEmpty('FechaCreacion');*/

        $validator
            ->date('FechaAltaConvocatoria')
            ->requirePresence('FechaAltaConvocatoria', 'create')
            ->notEmpty('FechaAltaConvocatoria')
			//->add('FechaAltaSolicitud', 'valid', ['rule' => ['date','dmy']]) ;
			->add('FechaAltaConvocatoria', [
				'NoPuedeSerFechaPasada' => [
					'rule' => ['NoPuedeSerFechaPasada'],
					'message' => 'La fecha selecionada no puede ser anterior a la fecha actual.',
					'provider' => 'table'
				],
				
			]); 

        $validator
            ->date('FechaBajaConvocatoria')
            ->requirePresence('FechaBajaConvocatoria', 'create')
            ->notEmpty('FechaBajaConvocatoria')
			->add('FechaBajaConvocatoria', [
				'NoPuedeSerAnteriorAlta' => [
					'rule' => ['NoPuedeSerAnteriorAlta'],
					'message' => 'La fecha selecionada no puede ser anterior a Fecha Alta Convocatoria.',
					'provider' => 'table'
				]
			]); 

        $validator
            ->date('FechaAltaReclamacion')
            ->requirePresence('FechaAltaReclamacion', 'create')
            ->notEmpty('FechaAltaReclamacion') 
			->add('FechaAltaReclamacion', [
				'NoPuedeSerAnteriorBaja' => [
					'rule' => ['NoPuedeSerAnteriorBaja'],
					'message' => 'La fecha selecionada no puede ser anterior a Fecha Baja Convocatoria.',
					'provider' => 'table'
				]
			]); 

        $validator
            ->date('FechaBajaReclamacion')
            ->requirePresence('FechaBajaReclamacion', 'create')
            ->notEmpty('FechaBajaReclamacion') 
			->add('FechaBajaReclamacion', [
				'NoPuedeSerAnteriorAltaRec' => [
					'rule' => ['NoPuedeSerAnteriorAltaRec'],
					'message' => 'La fecha selecionada no puede ser anterior a Fecha Alta Reclamacion.',
					'provider' => 'table'
				]
			]);  

        $validator
            ->date('FechaAltaReclamacionEvaluacion')
            ->requirePresence('FechaAltaReclamacionEvaluacion', 'create')
            ->notEmpty('FechaAltaReclamacionEvaluacion') 
			->add('FechaAltaReclamacionEvaluacion', [
				'NoPuedeSerAnteriorAltaRec' => [
					'rule' => ['NoPuedeSerAnteriorAltaRec'],
					'message' => 'La fecha selecionada no puede ser anterior a Fecha Alta Reclamacion.',
					'provider' => 'table'
				]
			]);
        
        $validator
            ->date('FechaBajaReclamacionEvaluacion')
            ->requirePresence('FechaBajaReclamacionEvaluacion', 'create')
            ->notEmpty('FechaBajaReclamacionEvaluacion') 
			->add('FechaBajaReclamacionEvaluacion', [
				'NoPuedeSerAnteriorAltaRec' => [
					'rule' => ['NoPuedeSerAnteriorAltaRec'],
					'message' => 'La fecha selecionada no puede ser anterior a Fecha Alta Reclamacion.',
					'provider' => 'table'
				]
			]);        
            
        $validator
            ->date('FechaEvaluacion')
            ->requirePresence('FechaEvaluacion', 'create')
            ->notEmpty('FechaEvaluacion') 
			->add('FechaEvaluacion', [
				'NoPuedeSerAnteriorBaja' => [
					'rule' => ['NoPuedeSerAnteriorBaja'],
					'message' => 'La fecha selecionada no puede ser anterior a Fecha Baja Convocatoria.',
					'provider' => 'table'
				]
			]);
        
        $validator
            ->date('FechaAdmitidos')
            ->requirePresence('FechaAdmitidos', 'create')
            ->notEmpty('FechaAdmitidos'); 

        $validator
            ->boolean('ListadoAdmitidos')
            ->allowEmpty('ListadoAdmitidos');

        $validator
            ->boolean('ListadoEvaluados')
            ->allowEmpty('ListadoEvaluados');

        $validator
            ->scalar('UltimaFase')
            ->maxLength('UltimaFase', 100)
            ->allowEmpty('UltimaFase');

        $validator
            ->boolean('Visible')
            ->requirePresence('Visible', 'create')
            ->notEmpty('Visible');

        return $validator;
    }

	function NoPuedeSerFechaPasada($date)
	{
		$valid = false;
		$fechaactual = date("d/m/Y");
		$date = implode("/", $date);	
		//$tempArr = explode('/', $date);
		//$tempArr = $date;
		//$date = date("d/m/y", mktime(0, 0, 0, $tempArr[1], $tempArr[0], $tempArr[2]));
		//$fechaalta = date("d/m/y");
		
		//echo "fecha actual: " . $fechaactual;
		//echo "<br>";
		//echo "fecha alta: " . $date;
		//echo "<br>";
		//$newdate = date("d/m/y", strtotime($fechaalta));
		//echo "fecha alta con dos digitos: " . $newdate;
		//die();
		
		
		if($date < $fechaactual)
		{
			$valid = false;
		}else
		{
			$valid = true;
		}
		
		return $valid;
    }

	function NoPuedeSerAnteriorAlta($date, array $context) 
	{
		$valid = false;
		$alta = $context['data']['FechaAltaConvocatoria'];
		$alta = implode("/", $alta);
		$date = implode("/", $date);
		
		if($date < $alta)
		{
			$valid = false;
		}else
		{
			$valid = true;
		}		
		
		return $valid;
	}
	
	function NoPuedeSerAnteriorBaja($date, array $context) 
	{
		$valid = false;
		$baja = $context['data']['FechaBajaConvocatoria'];
        
		$baja = implode("/", $baja);
		$date = implode("/", $date);

		if($date < $baja)
		{
            $valid = false;
		}else
		{
			$valid = true;
		}		
		
		return $valid;
	}
	
	function NoPuedeSerAnteriorAltaRec($date, array $context) 
	{
		$valid = false;
		$altarec = $context['data']['FechaAltaReclamacion'];
		$altarec = implode("/", $altarec);
		$date = implode("/", $date);
		
		if($date < $altarec)
		{
			$valid = false;
		}else
		{
			$valid = true;
		}		
		
		return $valid;
	}
	
	
	//function NoPuedeSerAnteriorAlta($date) use ($this)

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
	 
	 
		echo "fecha actual: " . date("d/m/Y");
		echo "<br>";
		echo "FechaAltaSolicitud: " . $solicitude['FechaAltaSolicitud'];
		
		$fechaactual = date("d-m-Y");
		$fechaalta = $solicitude['FechaAltaSolicitud'];


			->add('FechaAltaSolicitud', 'valid', ['rule' => ['date', 'dmy']])


		if($fechaalta > $fechaactual)
		{
			echo "<br> LA FECHA DE ALTA ES ES MENOR!!!!!!!!";
		}else
		{
			echo "<br> LA FECHA DE ALTA ES  ES MAYOR!!!!!!!!";
		}	 
	 
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['Usuario_id'], 'Usuarios'));

        return $rules;
    }
}
