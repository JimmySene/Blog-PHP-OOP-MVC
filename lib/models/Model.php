<?php
require_once('lib/database.php');

abstract class Model
{
    protected $pdo;
    protected $table;

    function __construct()
    {
        $this->pdo = getPdo();
    }

      /**
     * Retourne l'item dont l'id est indiqué
     * @param integer $id
     * @return array|bool l'item si trouvé, false sinon
     */
    public function get(int $id)
    {
        $query = $this->pdo->prepare("SELECT * FROM $this->table WHERE id = :id");
        $query->execute(['id' => $id]);
        return $query->fetch();
    }

     /**
     * Retourne la liste des items triés ou non
     * @return array
     */
    public function getAll(?string $order = "") : array
    {
        $query = "SELECT * FROM $this->table";
        if($order) $query .= " ORDER BY ". $order;
        $resultats = $this->pdo->query($query);
        return $resultats->fetchAll();
    }

    /**
     * Supprime l'item avec l'id indiqué
     * @param integer $id
     * @return void
     */
    public function delete(int $id) : void
    {
        $query = $this->pdo->prepare("DELETE FROM $this->table WHERE id = :id");
        $query->execute(['id' => $id]);
    }
    
}