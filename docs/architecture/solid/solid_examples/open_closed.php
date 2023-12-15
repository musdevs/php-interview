<?php

// **************** Нарушает принцип Open-Closed ****************

// Для добавления нового типа доставки придется изменять код класса WrongOrder
class WrongOrder
{
    private $lineItems;
    private $shipping;

    public function getTotal()
    {

    }

    public function getTotalWeight()
    {

    }

    public function setShippingType(string $type)
    {
        $this->shipping = $type;
    }

    public function getShippingCost()
    {
        if ($this->shipping === 'ground') {
            // Бесплатно для больших заказов
            if ($this->getTotal() > 100) {
                return 0;
            }

            // 1.5$ за килограмм, но не меньше $10
            return max(10, $this->getTotalWeight() * 1.5);
        }

        if ($this->shipping === 'air') {
            // 3$ за килограмм, но не меньше $20
            return max(20, $this->getTotalWeight() * 3);
        }
    }

    public function getShippingDate()
    {

    }
}

// **************** Соответствует принципу Open-Closed ****************

// Теперь при добавлении нового способа доставки нужно
// будет реализовать новый класс интерфейса доставки, не трогая класс заказов.

interface Shipping
{
    public function getCost(Order $order);
    public function getDate(Order $order);
}

class Ground implements Shipping
{
    public function getCost(Order $order)
    {
        // Бесплатно для больших заказов
        if ($order->getTotal() > 100) {
            return 0;
        }

        // 1.5$ за килограмм, но не меньше $10
        return max(10, $order->getTotalWeight() * 1.5);
    }

    public function getDate(Order $order)
    {
        // TODO: Implement getDate() method.
    }
}

class Air implements Shipping
{
    public function getCost(Order $order)
    {
        // 3$ за килограмм, но не меньше $20
        return max(20, $order->getTotalWeight() * 3);
    }

    public function getDate(Order $order)
    {
        // TODO: Implement getDate() method.
    }
}

class Order
{
    private $lineItems;
    private Shipping $shipping;

    public function getTotal()
    {

    }

    public function getTotalWeight()
    {

    }

    public function setShippingType(Shipping $shipping)
    {
        $this->shipping = $shipping;
    }

    public function getShippingCost()
    {
        return $this->shipping->getCost($this);
    }

    public function getShippingDate()
    {

    }
}
