<?php


/**
 * Class Klant
 */
class Reservering extends Klant
{
    public int $id;
    public string $datum;
    public string $tijd;
    public string $plaats;
    public string $klant_id;
    public string $fotograaf_id;


    /**
     * @return reservering[]
     */
//    public function getReserveringen(): array
//    {
//        return $this->reserveringen;
//    }
//    public function getKlant()
//    {
//        return $
//    }
}