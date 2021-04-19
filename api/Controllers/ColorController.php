<?php

namespace Controllers;

use ColorRepository;

class ColorController
{

    /**
     * ColorController constructor.
     */
    public function __construct()
    {
        $this->colorRepository = new ColorRepository();
    }

    /**
     * @return array|null
     */
    public function getColors()
    {
        $colors = $this->colorRepository->getAll();
        if (!$colors) {
            header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found", true, 404);
            return;
        }

        header('Content-Type: application/json');
        echo json_encode($colors);
    }

    /**
     * @param int $id
     */
    public function getColorById(int $id)
    {
        $color = $this->colorRepository->getById($id);
        if (!$color) {
            header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found", true, 404);
            return;
        }
        header('Content-Type: application/json');
        echo json_encode($color);
    }

    /**
     * @param string $code
     */
    public function getColorByCode(string $code)
    {
        $color = $this->colorRepository->getByCode($code);
        if (!$color) {
            header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found", true, 404);
            return;
        }
        header('Content-Type: application/json');
        echo json_encode($color);
    }

    /**
     * @param string $name
     */
    public function getColorByName(string $name)
    {
        $color = $this->colorRepository->getByName($name);
        if (!$color) {
            header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found", true, 404);
            return;
        }
        header('Content-Type: application/json');
        echo json_encode($color);
    }

    public function saveColor()
    {
        $code = $_POST['code'];
        if (!ctype_xdigit($code) && (strlen($code) === 6 || strlen($code) === 3)){
            header($_SERVER["SERVER_PROTOCOL"]." 400 Bad Request", true, 400);
            return;
        }
        header('Content-Type: application/json');
        echo json_encode($this->colorRepository->saveColor($code, $_POST['name']));
    }

    /**
     * @param int $id
     */
    public function deleteColorById(int $id)
    {
        $this->colorRepository->deleteById($id);
    }

    /**
     * @param string $code
     */
    public function deleteColorByCode(string $code)
    {
        $this->colorRepository->deleteByCode($code);
    }

    /**
     * @param string $name
     */
    public function deleteColorByName(string $name)
    {
        $this->colorRepository->deleteByName($name);
    }
}