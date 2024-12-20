<?php
declare(strict_types=1);

namespace Business;

use Data\PizzaDAO;

class PizzaService 
{
    // CREATE
    public function createNewPizza()
    {
        $pizzaDAO = new PizzaDAO();
        $pizzaDAO->create();
    } 

    // READ
    public function getAllPizza(): array
    {
        $pizzaDAO = new PizzaDAO();
        $pizzas = $pizzaDAO->getAll();
        return $pizzas;
    }

    public function getPizzaById(int $id)
    {
        $pizzaDAO = new PizzaDAO();
        $pizza = $pizzaDAO->getById($id);
        return $pizza;
    }

    // UPDATE

    // DELETE
    public function deletePizza()
    {
        $pizzaDAO = new PizzaDAO();
        $pizzaDAO->delete();
    }
}