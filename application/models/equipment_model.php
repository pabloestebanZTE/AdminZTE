<?php
	//require_once 'Profesor_model.php';

	class equipment_model extends CI_Model{

		protected $id;
		protected $categoria;
		protected $tipo;
		protected $serial;
		protected $other;
		protected $marca;
    protected $modelo;

		public function __construct(){

		}
		public function getId(){return $this->id;}

		public function setId($id){$this->id = $id;}

		public function getCategoria(){return $this->categoria;}

		public function setCategoria($categoria){$this->categoria = $categoria;}

    public function getTipo(){return $this->tipo;}

    public function setTipo($tipo){$this->tipo = $tipo;}

		public function getOther(){return $this->other;}

		public function setOther($other){$this->other = $other;}

    public function getSerial(){return $this->serial;}

    public function setSerial($serial){$this->serial = $serial;}

    public function getMarca(){return $this->marca;}

    public function setMarca($marca){$this->marca = $marca;}

    public function getModelo(){return $this->modelo;}

    public function setModelo($modelo){$this->modelo = $modelo;}

		public function createEquipment($id, $categoria, $tipo, $other,$serial, $marca, $modelo){
			$newEquipment = new equipment_model();
			$newEquipment->setId($id);
			$newEquipment->setCategoria($categoria);
			$newEquipment->setTipo($tipo);
			$newEquipment->setOther($other);
			$newEquipment->setSerial($serial);
			$newEquipment->setMarca($marca);
      $newEquipment->setModelo($modelo);

			return $newEquipment;
    }
	}
?>
