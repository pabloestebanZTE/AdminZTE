<?php
	//require_once 'Profesor_model.php';

	class ticket_model extends CI_Model{

		protected $id;
		protected $idMaintenance;
    protected $status;
    protected $dateStart;
		protected $dateFinish;
		protected $duracion;

		public function __construct(){

		}

		public function getId(){return $this->id;}

		public function setId($id){$this->id = $id;}

    public function getIdM(){return $this->idMaintenance;}

    public function setIdM($idMaintenance){$this->idMaintenance = $idMaintenance;}

    public function getStatus(){return $this->status;}

    public function setStatus($status){$this->status = $status;}

    public function getDateS(){return $this->dateStart;}

    public function setDateS($dateStart){$this->dateStart = $dateStart;}

    public function getDateF(){return $this->dateFinish;}

    public function setDateF($dateFinish){$this->dateFinish = $dateFinish;}

    public function getDuracion(){return $this->duracion;}

    public function setDuracion($duracion){$this->duracion = $duracion;}

		public function createTicket($id, $idMaintenance, $status, $dateStart, $dateFinish, $duracion){
      $newTicket= new ticket_model();
			$newTicket->setId($id);
			$newTicket->setIdM($idMaintenance);
      $newTicket->setStatus($status);
      $newTicket->setDateS($dateStart);
      $newTicket->setDateF($dateFinish);
      $newTicket->setDuracion($duracion);
			return $newTicket;
    }
	}
?>
