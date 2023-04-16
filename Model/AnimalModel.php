<?php
require_once PROJECT_ROOT_PATH . "/Model/Database.php";
class AnimalModel extends Database
{
    public function search($name=null, $year=null)
    {
        $query = "SELECT * FROM animaux ";
        
        if($name != null ){
            $filter[] = "nom LIKE ?";
            $params[] = "$name%";
        }

        if($year != null){
            $filter[] = "annee = ?";
            $params[] = $year;
        }

        if(!empty($filter)){
            $query .= "WHERE ". implode(" AND ", $filter);
        } else {
            $params = array();
        }
    
        $stmt = $this->execute($query, $params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function read($id = null)
    {
        $query = "SELECT * FROM animaux ";
        if($id != null){
            $query .= "WHERE id = ? ORDER BY nom ASC";
            $params[] = $id;
        }else{
            $params = array();
        }
        $stmt = $this->execute($query, $params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($data)
    {
        $query = "INSERT INTO animaux (nom, personne, annee, photo) VALUES (?, ?, ?, ?)";
        $params = array($data['nom'], $data['personne'], $data['annee'], $data['photo']);
        $stmt = $this->execute($query, $params);
        if ($stmt) {
            return true;
        } else {
            return false;
        }
    }

    public function update($id, $data)
    {
        $query = "UPDATE animaux SET ";
        $params = array();

        if (array_key_exists('nom', $data)) {
            $query .= "nom = ?, ";
            $params[] = $data['nom'];
        }
        
        if (isset($data['personne'])) {
            $query .= "personne = ?, ";
            $params[] = $data['personne'];
        }

        if (isset($data['annee'])) {
            $query .= "annee = ?, ";
            $params[] = $data['annee'];
        }

        if (isset($data['photo'])) {
            $query .= "photo = ?, ";
            $params[] = $data['photo'];
        }

        // remove trailing comma
        $query = rtrim($query, ", ");
        
        // add id condition
        $query .= " WHERE id = ?";
        $params[] = $id;


        $stmt = $this->execute($query, $params);
        if ($stmt) {
            return true;
        } else {
            return false;
        }
    }

    public function delete($id)
    {
        $query = "DELETE FROM animaux WHERE id = ?";
        $params = array($id);
        $stmt = $this->execute($query, $params);
        if ($stmt) {
            return true;
        } else {
            return false;
        }
    }
}
