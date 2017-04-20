<?php
	//require_once 'Profesor_model.php';

	class equipment_model extends CI_Model{

		protected $categoria;
		protected $tipo;
		protected $serial;
		protected $marca;
    protected $modelo;

		public function __construct(){

		}

		public function getCategoria(){return $this->categoria;}

		public function setCategoria($categoria){$this->categoria = $categoria;}

    public function getTipo(){return $this->tipo;}

    public function setTipo($tipo){$this->tipo = $tipo;}

    public function getSerial(){return $this->serial;}

    public function setSerial($serial){$this->serial = $serial;}

    public function getMarca(){return $this->marca;}

    public function setMarca($marca){$this->marca = $marca;}

    public function getModelo(){return $this->modelo;}

    public function setModelo($modelo){$this->modelo = $modelo;}

		public function createEquipment($categoria, $tipo, $serial, $marca, $modelo){
			$newEquipment = new equipment_model();
			$newEquipment->setCategoria($categoria);
			$newEquipment->setTipo($tipo);
			$newEquipment->serSerial($serial);
			$newEquipment->serMarca($marca);
      $newEquipment->setModelo($modelo);

			return $newEquipment;
    }
	}
?>
