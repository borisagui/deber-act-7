<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class UserController extends Controller
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function index(): string
    {
        return view('index.html');
    }

    public function getAllUsers()
    {
        $query = $this->db->query('SELECT id, name, email FROM users');
        $results = $query->getResult();
        return $this->response->setJSON($results);
    }

    public function insertar($name, $email)
    {
        $query = $this->db->query("
            INSERT INTO users (name, email) 
            VALUES ('$name', '$email')
        ");
        
        if ($query) {
            $insertedId = $this->db->insertID();
            return $this->response->setJSON(['id' => $insertedId, 'message' => 'Usuario Insertado Correctamente']);
        } else {
            return $this->response->setJSON(['error' => 'Fallo de la Insercion del Usuario']);
        }
    }

    public function modificar($id, $name, $email)
    {
        $query = $this->db->query("
            UPDATE users 
            SET name = '$name', email = '$email' 
            WHERE id = $id
        ");
        
        if ($this->db->affectedRows() > 0) {
            return $this->response->setJSON(['message' => 'Usuario Modificado Correctamente']);
        } else {
            return $this->response->setJSON(['error' => 'Fallo de la Modificacion del Usuario o Usuario no encontrado']);
        }
    }

    public function eliminar($id)
    {
        $query = $this->db->query("
            DELETE FROM users 
            WHERE id = $id
        ");
        
        if ($this->db->affectedRows() > 0) {
            return $this->response->setJSON(['message' => 'Usuario Eliminado Correctamente']);
        } else {
            return $this->response->setJSON(['error' => 'Fallo de la Eliminacion del Usuario o Usuario no encontrado']);
        }
    }
}