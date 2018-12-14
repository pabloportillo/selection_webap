<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Usuarios Model
 *
 * @property \App\Model\Table\PerfilesTable|\Cake\ORM\Association\BelongsTo $Perfiles
 * @property \App\Model\Table\EmpresasTable|\Cake\ORM\Association\BelongsTo $Empresas
 *
 * @method \App\Model\Entity\Usuario get($primaryKey, $options = [])
 * @method \App\Model\Entity\Usuario newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Usuario[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Usuario|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Usuario patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Usuario[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Usuario findOrCreate($search, callable $callback = null, $options = [])
 */
class UsuariosTable extends Table
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

        $this->setTable('usuarios');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Perfiles', [
            'foreignKey' => 'Perfile_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Empresas', [
            'foreignKey' => 'Empresa_id'
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
            ->maxLength('Nombre', 60)
            ->requirePresence('Nombre', 'create')
            ->notEmpty('Nombre');

        $validator
            ->scalar('Apellidos')
            ->maxLength('Apellidos', 200)
            ->requirePresence('Apellidos', 'create')
            ->notEmpty('Apellidos');

        $validator
            ->scalar('Dni')
            ->maxLength('Dni', 9)
            ->allowEmpty('Dni')
			->add('Dni', [
				'lengthbetween' => [
					'rule' => ['lengthbetween', 9, 9],
					'last' => true, // Si quieres parar la ejecución cuando esta condición falla ponemos el last true.
					'message' => 'Introduzca un DNI válido.'
				],
				'isValidIdNumber' => [
					'rule' => 'isValidIdNumber',
					'message' => 'DNI/NIF no valido',
					'provider' => 'table' // PROVIDER TABLE para que pille el script de esta misma página. si no, no lo pilla.
				 ]
			]);

        $validator
            ->scalar('Direccion')
            ->maxLength('Direccion', 200)
            ->allowEmpty('Direccion');

        $validator
            ->scalar('Email')
            ->maxLength('Email', 60)
            ->requirePresence('Email', 'create')
            ->notEmpty('Email')
			->email('Email')
            ->add('Email', 'unique', ['rule' => 'validateUnique', 'provider' => 'table', 'message' => 'Email ya existente en la base de datos']);

		$validator
            ->scalar('Contraseña')
            ->maxLength('Contraseña', 100)
            ->requirePresence('Contraseña', 'create')
            ->notEmpty('Contraseña')
			// PORTILLO: añadido regla para validar la contraseña. 
			->add('Contraseña', [
				'minLength' => [
					'rule' => ['minLength', 8],
					'last' => true, // Si quieres parar la ejecución cuando esta condición falla ponemos el last true.
					'message' => 'La contraseña debe de estar compuesta de ocho caracteres como mínimo y contener al menos un caracter especial, un número, un caracter en mayúscula y otro en minúscula.'
				],
				'encPasswordCheckFailed' => [
					'rule' => ['encPasswordCheckFailed'],
					'message' => 'La contraseña debe de estar compuesta de ocho caracteres como mínimo y contener al menos un caracter especial, un número, un caracter en mayúscula y otro en minúscula.',
					'provider' => 'table'
				]
			]);
		
		// VALIDADOR PARA CONFIRMAR CONTRASEÑA 
		/*
		$validator
			->notEmpty('Contraseña_match')
			->sameAs('Contraseña_match','Contraseña','Las contraseñas no coinciden.'); 
		*/

		
        $validator
            ->scalar('Telefono')
            ->requirePresence('Telefono', 'create')
            ->notEmpty('Telefono')
			// PORTILLO: añadido regla para validar telefono.
			->add('Telefono', [
				'lengthbetween' => [
					'rule' => ['lengthbetween', 9, 12],
					'last' => true, // Si quieres parar la ejecución cuando esta condición falla ponemos el last true.
					'message' => 'Introduce al menos 9 dígitos numéricos.'
				],
				'numeric' => [
					'rule' => ['numeric'],
					'message' => 'Introduce al menos 9 dígitos numéricos.'
				]
			]);

        $validator
            ->boolean('Activo')
            ->requirePresence('Activo', 'create')
            ->notEmpty('Activo');

        $validator
            ->scalar('Localidad')
            ->maxLength('Localidad', 45)
            ->allowEmpty('Localidad');

        $validator
            ->scalar('Cp')
            ->maxLength('Cp', 5)
            ->allowEmpty('Cp')
			->add('Cp', [
				'lengthbetween' => [
					'rule' => ['lengthbetween', 5, 5],
					'last' => true, // Si quieres parar la ejecución cuando esta condición falla ponemos el last true.
					'message' => 'Código Postal debe de constar de 5 digitos numéricos.'
				],
				'numeric' => [
					'rule' => ['numeric'],
					'message' => 'Código Postal debe de constar de 5 digitos numéricos.'
				]
			]);

        $validator
            ->allowEmpty('Foto')
            ->add('Foto', [
                'validExtension' => [
                    'rule' => ['extension',['jpeg', 'png', 'jpg']], // default  ['gif', 'jpeg', 'png', 'jpg']
                    'message' => 'La foto ha de tener extension: .png .jpeg o .jpg.'
                ],
				'validSizeFile' => [
                    'rule' => ['fileSize', '<', '1500000'], 
                    'message' => 'La foto no puede ser mayor de 1.5MB.'
                ],
				'ErrorImageArray' => [
					'rule' => ['ErrorImageArray'],
					'message' => 'Ha habido un error en la subida. Por favor, intentelo de nuevo o pruebe con otra imagen.',
					'provider' => 'table'
				]
			]);

        return $validator;
    }

/*
* PORTILLO:
*
* Funciones para validar la FOTO. 
* foto['error] solo puede tener valor 4 (no se ha subido una foto) o valor 0 (no se encuentran errores)
*/	
	
    public static function ErrorImageArray($foto) {

		$not_allowed_errors = array(
			1,
			2,
			3,
			6,
			7,
			8
		);
		
		if (in_array($foto['error'], $not_allowed_errors)) {
			
			return false;
		}

        return true;
    }	

/*
* PORTILLO:
*
* Funciones para validar la CONTRASEÑA. 
* Tener en cuenta, que al llamar a otras funciones tienes que poner delante de la llamada $this->
*
* Sacada de aqui:
* https://github.com/amnesty/drupal-nif-nie-cif-validator/blob/master/includes/nif-nie-cif.php
*/	
	

    public static function encPasswordCheckFailed($password) {
        // THIS READS:
        // IF THE PASSWORD DOES CONTAIN AN UPPER-CASE CHARACTER
        // AND ALSO DOES CONTAIN A LOWER-CASE CHARACTER
        // AND STILL DOES CONTAIN A NUMERIC CHARACTER
        // AND EVEN MORE, DOES CONTAIN ANY  OF THE SPECIFIED SPECIAL CHARACTERS 
        // RETURN FALSE OTHERWISE RETURN TRUE
        if (preg_match('/[A-Z]+/', $password) &&                    // CHECK FOR UPPERCASE CHARACTER
            preg_match('/[a-z]+/', $password) &&                    // AND CHECK FOR LOWERCASE CHARACTER
            preg_match('/[0-9]+/', $password)&&                     // AND CHECK FOR NUMERIC CHARACTER
            preg_match('/[\!@#$%\^&\*\(\)\-\+<>]+/', $password)     // AND CHECK FOR SPECIAL CHARACTER
        ) {
            return true;
        }

        return false;
    }	
		
	
/*
* PORTILLO:
*
* Funciones para validar el NIF/NIE. 
* Tener en cuenta, que al llamar a otras funciones tienes que poner delante de la llamada $this->
*
* Sacada de aqui:
* https://github.com/amnesty/drupal-nif-nie-cif-validator/blob/master/includes/nif-nie-cif.php
*/

	
	public function isValidIdNumber( $docNumber ) {
        $fixedDocNumber = strtoupper( $docNumber );
        return $this->isValidNIF( $fixedDocNumber ) || $this->isValidNIE( $fixedDocNumber );
    }
	
	public function isValidNIF( $docNumber ) {
        $isValid = FALSE;
        $fixedDocNumber = "";
        $correctDigit = "";
        $writtenDigit = "";
        if( !preg_match( "/^[A-Z]+$/i", substr( $fixedDocNumber, 1, 1 ) ) ) {
            $fixedDocNumber = strtoupper( substr( "000000000" . $docNumber, -9 ) );
        } else {
            $fixedDocNumber = strtoupper( $docNumber );
        }
        $writtenDigit = strtoupper(substr( $docNumber, -1, 1 ));
        if( $this->isValidNIFFormat( $fixedDocNumber ) ) {
            $correctDigit = $this->getNIFCheckDigit( $fixedDocNumber );
            if( $writtenDigit == $correctDigit ) {
                $isValid = TRUE;
            }
        }
        return $isValid;
    }
	
	public function isValidNIFFormat( $docNumber ) {
        return $this->respectsDocPattern(
            $docNumber,
            '/^[KLM0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][a-zA-Z0-9]/' );
    }
	
	public function getNIFCheckDigit( $docNumber ) {
			$keyString = 'TRWAGMYFPDXBNJZSQVHLCKE';
			$fixedDocNumber = "";
			$position = 0;
			$writtenLetter = "";
			$correctLetter = "";
			if( !preg_match( "/^[A-Z]+$/i", substr( $fixedDocNumber, 1, 1 ) ) ) {
				$fixedDocNumber = strtoupper( substr( "000000000" . $docNumber, -9 ) );
			} else {
				$fixedDocNumber = strtoupper( $docNumber );
			}
			if( $this->isValidNIFFormat( $fixedDocNumber ) ) {
				$writtenLetter = substr( $fixedDocNumber, -1 );
				if( $this->isValidNIFFormat( $fixedDocNumber ) ) {
					$fixedDocNumber = str_replace( 'K', '0', $fixedDocNumber );
					$fixedDocNumber = str_replace( 'L', '0', $fixedDocNumber );
					$fixedDocNumber = str_replace( 'M', '0', $fixedDocNumber );
					$position = substr( $fixedDocNumber, 0, 8 ) % 23;
					$correctLetter = substr( $keyString, $position, 1 );
				}
			}
			return $correctLetter;
		}
	
	public function isValidNIE( $docNumber ) {
        $isValid = FALSE;
        $fixedDocNumber = "";
        if( !preg_match( "/^[A-Z]+$/i", substr( $fixedDocNumber, 1, 1 ) ) ) {
            $fixedDocNumber = strtoupper( substr( "000000000" . $docNumber, -9 ) );
        } else {
            $fixedDocNumber = strtoupper( $docNumber );
        }
        if( $this->isValidNIEFormat( $fixedDocNumber ) ) {
            if( substr( $fixedDocNumber, 1, 1 ) == "T" ) {
                $isValid = TRUE;
            } else {
                /* The algorithm for validating the check digits of a NIE number is
                    identical to the altorithm for validating NIF numbers. We only have to
                    replace Y, X and Z with 1, 0 and 2 respectively; and then, run
                    the NIF altorithm */
                $numberWithoutLast = substr( $fixedDocNumber, 0, strlen($fixedDocNumber)-1 );
                $lastDigit = substr( $fixedDocNumber, strlen($fixedDocNumber)-1, strlen($fixedDocNumber) );
                $numberWithoutLast = str_replace('Y', '1', $numberWithoutLast);
                $numberWithoutLast = str_replace('X', '0', $numberWithoutLast);
                $numberWithoutLast = str_replace('Z', '2', $numberWithoutLast);
                $fixedDocNumber = $numberWithoutLast . $lastDigit;
                $isValid = $this->isValidNIF( $fixedDocNumber );
            }
        }
        return $isValid;
    }
	
	public function isValidNIEFormat( $docNumber ) {
        return $this->respectsDocPattern(
            $docNumber,
            '/^[XYZT][0-9][0-9][0-9][0-9][0-9][0-9][0-9][A-Z0-9]/' );
    }
	
	public function respectsDocPattern( $givenString, $pattern ) {
        $isValid = FALSE;
        $fixedString = strtoupper( $givenString );
        if( is_int( substr( $fixedString, 0, 1 ) ) ) {
            $fixedString = substr( "000000000" . $givenString , -9 );
        }
        if( preg_match( $pattern, $fixedString ) ) {
            $isValid = TRUE;
        }
        return $isValid;
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
        //$rules->add($rules->isUnique(['Dni']));
        $rules->add($rules->isUnique(['Email']));
        $rules->add($rules->existsIn(['Perfile_id'], 'Perfiles'));
        $rules->add($rules->existsIn(['Empresa_id'], 'Empresas'));

        return $rules;
    }
}
