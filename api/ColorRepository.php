<?php

use Models\Color;

class ColorRepository
{
    public function __construct()
    {
        $this->db = new SQLite3('colors-api.db');
    }


    /**
     * @param string $code
     * @param string $name
     */
    public function saveColor(string $code, string $name)
    {
        $stm = $this->db->prepare('INSERT INTO color (name, color) VALUES (:name, :color)');
        $stm->bindValue(':name', $name, SQLITE3_TEXT);
        $stm->bindValue(':color', $code, SQLITE3_TEXT);
        $stm->execute();
        return [
            'name' => $name,
            'color' => $code,
            'id' => $this->db->lastInsertRowID()
        ];
    }

    /**
     * @return array|false
     */
    public function getAll()
    {
        $stm = $this->db->query('SELECT * FROM color');
        $rows = [];

        while ($row = $stm->fetchArray(SQLITE3_ASSOC)) {
            $rows[] = $row;
        }

        return $rows;
    }

    /**
     * @param string $code
     * @return array|false
     */
    public function getByCode(string $code)
    {
        $stm = $this->db->prepare('SELECT * FROM color WHERE color = ?');
        $stm->bindValue(1, $code, SQLITE3_TEXT);
        $res = $stm->execute();
        return $res->fetchArray(SQLITE3_ASSOC);
    }

    /**
     * @param string $name
     * @return array|false
     */
    public function getByName(string $name)
    {
        $stm = $this->db->prepare('SELECT * FROM color WHERE name = ?');
        $stm->bindValue(1, $name, SQLITE3_TEXT);
        $res = $stm->execute();
        return $res->fetchArray(SQLITE3_ASSOC);
    }

    /**
     * @param string $id
     * @return array|false
     */
    public function getById(string $id)
    {
        $stm = $this->db->prepare('SELECT * FROM color WHERE id = ?');
        $stm->bindValue(1, $id, SQLITE3_TEXT);
        $res = $stm->execute();
        return $res->fetchArray(SQLITE3_ASSOC);
    }

    /**
     * @param string $code
     * @return array|false
     */
    public function deleteByCode(string $code)
    {
        $stm = $this->db->prepare('DELETE FROM color WHERE color = ?');
        $stm->bindValue(1, $code, SQLITE3_TEXT);
        $res = $stm->execute();
        return $res->fetchArray(SQLITE3_ASSOC);
    }

    /**
     * @param string $name
     * @return array|false
     */
    public function deleteByName(string $name)
    {
        $stm = $this->db->prepare('DELETE FROM color WHERE name = ?');
        $stm->bindValue(1, $name, SQLITE3_TEXT);
        $res = $stm->execute();
        return $res->fetchArray(SQLITE3_ASSOC);
    }

    /**
     * @param int $id
     * @return array|false
     */
    public function deleteById(int $id)
    {
        $stm = $this->db->prepare('DELETE FROM color WHERE id = ?');
        $stm->bindValue(1, $id, SQLITE3_INTEGER);
        $res = $stm->execute();
        return $res->fetchArray(SQLITE3_ASSOC);
    }


}