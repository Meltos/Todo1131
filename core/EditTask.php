<?php
namespace Core;

class EditTask
{
    public $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function addTask($data)
    {
        if ($data == '' or empty($data)) {
            return;
        }
        $sql = "INSERT INTO `tasks` (`task`) VALUES (:task)";
        $query = $this->pdo->prepare($sql);
        $query->execute([':task'=>$data]);
    }

    public function completeTask($id)
    {
        $sth = $this->pdo->prepare("UPDATE `tasks` SET `done` = :name WHERE `id` = :id");
        $sth->execute(array('name' => 'disabled', 'id' => $id));
    }

    public function editTask($id, $name)
    {
        $sth = $this->pdo->prepare("UPDATE `tasks` SET `task` = :name WHERE `id` = :id");
        $sth->execute(array('name' => $name, 'id' => $id));
    }

    public function deleteTask($id)
    {
        $sql = 'DELETE FROM `tasks` WHERE `id` = ?';
        $query = $this->pdo->prepare($sql);
        $query->execute([$id]);
    }
}