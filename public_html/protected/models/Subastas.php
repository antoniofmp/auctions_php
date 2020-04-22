<?php

/**
 * This is the model class for table "subastas".
 *
 * The followings are the available columns in table 'subastas':
 * @property integer $id
 * @property string $identificador
 * @property string $fechaFin
 * @property string $tasacion
 * @property string $cantReclamada
 * @property string $direccion
 * @property string $localidad
 * @property string $nombreAcreedor
 * @property string $acreedor
 */
class Subastas extends CActiveRecord
{
    public $from_date;
    public $to_date;
    public $fecha;
    public $from_coef;
    public $to_coef; 
    public $desdeSubasta; //donde empieza en la URL (id de subasta) a hacer las iteraciones
    public $numIteraciones; //num. iteraciones
    public $borrar; 
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Subastas the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'subastas';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id', 'numerical', 'integerOnly'=>true),
                       // array('from_coef', 'to_coef', 'type'=>'float'),
			array('identificador, fechaFin, tasacion, cantReclamada, direccion, localidad, nombreAcreedor, acreedor, coeficiente, codigoPostal', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, identificador, fechaFin, tasacion, cantReclamada, direccion, localidad, nombreAcreedor, coeficiente, codigoPostal, acreedor', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'identificador' => 'Identificador',
			'fechaFin' => 'Fecha Fin',
			'tasacion' => 'Valor',
			'cantReclamada' => 'Cant Reclam',
			'direccion' => 'Direc J # B',
                        'codigoPostal' => 'Cod Post',
			'localidad' => 'Localidad Bien',
			'nombreAcreedor' => 'Nombre Acreedor',
                        'acreedor' => 'Acree # Pr',
                        'coeficiente' => 'Coefic',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		$criteria=new CDbCriteria;
                
                /* Se establecen los criterios para la búsqueda por rango de fechas */                
                if(!empty($this->from_date) && empty($this->to_date) && empty($this->from_coef) && empty($this->to_coef))
                {
                    $criteria->condition = "fechaFin >= '$this->from_date'";
                }
                elseif(!empty($this->from_date) && !empty($this->to_date) && empty($this->from_coef) && empty($this->to_coef))
                {
                    $criteria->condition = "fechaFin  >= '$this->from_date' and fechaFin <= '$this->to_date'";
                }
                elseif(empty($this->from_date) && !empty($this->to_date) && empty($this->from_coef) && empty($this->to_coef))
                {
                    $criteria->condition = "fechaFin <= '$this->to_date'";
                }
                elseif(empty($this->from_date) && empty($this->to_date) && !empty($this->from_coef) && empty($this->to_coef))
                {
                    $criteria->condition = "coeficiente >= $this->from_coef";
                }
                elseif(empty($this->from_date) && empty($this->to_date) && empty($this->from_coef) && !empty($this->to_coef))
                {
                    $criteria->condition = "coeficiente <= $this->to_coef";
                }
                elseif(empty($this->from_date) && empty($this->to_date) && !empty($this->from_coef) && !empty($this->to_coef))
                {
                    $criteria->condition = "coeficiente  >= $this->from_coef and coeficiente <= $this->to_coef";
                }
                elseif(!empty($this->from_date) && empty($this->to_date) && !empty($this->from_coef) && !empty($this->to_coef))
                {
                    $criteria->condition = "coeficiente  >= $this->from_coef and coeficiente <= $this->to_coef and fechaFin >= '$this->from_date'";
                }
                elseif(empty($this->from_date) && !empty($this->to_date) && !empty($this->from_coef) && !empty($this->to_coef))
                {
                    $criteria->condition = "coeficiente  >= $this->from_coef and coeficiente <= $this->to_coef and fechaFin <= '$this->to_date'";
                }
                elseif(!empty($this->from_date) && !empty($this->to_date) && !empty($this->from_coef) && !empty($this->to_coef))
                {
                    $criteria->condition = "coeficiente  >= $this->from_coef and coeficiente <= $this->to_coef and fechaFin  >= '$this->from_date' and fechaFin <= '$this->to_date'";
                }
                elseif(!empty($this->from_date) && !empty($this->to_date) && empty($this->from_coef) && !empty($this->to_coef))
                {
                    $criteria->condition = "coeficiente <= $this->to_coef and fechaFin  >= '$this->from_date' and fechaFin <= '$this->to_date'";
                }
                elseif(!empty($this->from_date) && !empty($this->to_date) && !empty($this->from_coef) && empty($this->to_coef))
                {
                    $criteria->condition = "coeficiente  >= $this->from_coef and fechaFin  >= '$this->from_date' and fechaFin <= '$this->to_date'";
                }
                elseif(!empty($this->from_date) && empty($this->to_date) && !empty($this->from_coef) && empty($this->to_coef))
                {
                    $criteria->condition = "coeficiente  >= $this->from_coef and fechaFin  >= '$this->from_date'";
                }
                elseif(empty($this->from_date) && !empty($this->to_date) && !empty($this->from_coef) && empty($this->to_coef))
                {
                    $criteria->condition = "coeficiente  >= $this->from_coef and fechaFin  <= '$this->to_date'";
                }
                elseif(!empty($this->from_date) && empty($this->to_date) && empty($this->from_coef) && !empty($this->to_coef))
                {
                    $criteria->condition = "coeficiente  <= $this->to_coef and fechaFin  >= '$this->from_date'";
                }
                elseif(empty($this->from_date) && !empty($this->to_date) && empty($this->from_coef) && !empty($this->to_coef))
                {
                    $criteria->condition = "coeficiente  <= $this->to_coef and fechaFin  <= '$this->to_date'";
                }
                
		$criteria->compare('id',$this->id);
		$criteria->compare('identificador',$this->identificador,true);
		$criteria->compare('fechaFin',$this->fechaFin,true);
		$criteria->compare('tasacion',$this->tasacion,true);
		$criteria->compare('cantReclamada',$this->cantReclamada,true);
		$criteria->compare('direccion',$this->direccion,true);
                $criteria->compare('codigoPostal',$this->codigoPostal,true);
		$criteria->compare('localidad',$this->localidad,true);
		$criteria->compare('nombreAcreedor',$this->nombreAcreedor,true);
                $criteria->compare('acreedor',$this->acreedor,true);
                $criteria->compare('coeficiente',$this->coeficiente);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                        'sort'=>array(
                            'defaultOrder'=>'fechaFin ASC',
                        ),
		));
	}
        
        public function getFechaFin($data)
        {
          $anio = substr($data->fechaFin,0,4);
          $mes = substr($data->fechaFin,5,2);
          $dia = substr($data->fechaFin,8,2);
          
          $fecha = $dia .'-'.$mes.'-'.$anio;
          
          return $fecha;
	}
}