<?php
	//require_once 'Profesor_model.php';

	class maintenance_model extends CI_Model{

		protected $id;
		protected $idPVD;
		protected $type;
		protected $date;
    protected $ticket;

		public function __construct(){

		}

		public function getId(){return $this->id;}

		public function setId($id){$this->id = $id;}

    public function getIdPVD(){return $this->idPVD;}

    public function setIdPVD($idPVD){$this->idPVD = $idPVD;}

    public function getType(){return $this->type;}

    public function setType($type){$this->type = $type;}

    public function getDate(){return $this->date;}

    public function setDate($date){$this->date = $date;}

    public function getTicket(){return $this->ticket;}

    public function setTicket($ticket){$this->ticket = $ticket;}

		public function createMaintenance($id, $idPVD, $type, $date){
			$newMaintenance= new maintenance_model();
			$newMaintenance->setId($id);
			$newMaintenance->setIdPVD($idPVD);
      $newMaintenance->setType($type);
      $newMaintenance->setDate($date);
			return $newMaintenance;
    }
	}
?>
