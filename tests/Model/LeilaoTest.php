<?php

namespace Alura\Leilao\Tests\Model;

use Alura\Leilao\Model\Lance;
use Alura\Leilao\Model\Leilao;
use Alura\Leilao\Model\Usuario;
use PHPUnit\Framework\TestCase;

class LeilaoTest extends TestCase
{

    public function testLeilaoNaoDeveReceberLancesRepetidos()
    {
        $leilao = new Leilao('Variante');
        $ana = new Usuario('Ana');

        $leilao -> recebeLance(new Lance($ana,1000));
        $leilao ->recebeLance(new Lance ($ana,1500));

        static :: assertCount(1, $leilao -> getLances());
        static :: assertEquals(1000,$leilao ->getLances()[0] ->getValor());
    }

    public function testeLeilaoNaoDeveAceitarMaisDe5LancesPorUsuario()
    {
        $leilao = new Leilao('Brasilia Amarela');
        $joao = new Usuario( 'João');
        $maria = new Usuario('Maria');

        $leilao -> recebeLance(new Lance($joao,1000));
        $leilao -> recebeLance(new Lance($maria,1500));
        $leilao -> recebeLance(new Lance($joao,2000));
        $leilao -> recebeLance(new Lance($maria,2500));
        $leilao -> recebeLance(new Lance($joao,3000));
        $leilao -> recebeLance(new Lance($maria,3500));
        $leilao -> recebeLance(new Lance($joao,4000));
        $leilao -> recebeLance(new Lance($maria,4500));
        $leilao -> recebeLance(new Lance($joao,5000));
        $leilao -> recebeLance(new Lance($maria,5500));

        $leilao -> recebeLance(new Lance($joao,6000));
        static :: assertCount(10, $leilao->getLances());
        static :: assertEquals(5500, $leilao -> getLances()[array_key_last($leilao->getLances())]->getValor());
    }

    /**
     * @dataProvider gerarLances
     */
    public function testLeilaoDeveReceberLance
    (int $qtdLances, Leilao $leilao , array $valores)
    {

        static::assertCount($qtdLances ,$leilao -> getLances());
        foreach ($valores as $i => $valorEsperado)
        {
            static :: assertEquals($valorEsperado,$leilao -> getLances()[$i] -> getValor());
        }



    }

    public function gerarLances
    ()
    {
        $joao = new Usuario('joão');
        $maria = new Usuario('Maria');
        $leilao = new Leilao("Fiat 147 Okm");
        $leilao-> recebeLance(new Lance($joao, 1000));
        $leilao -> recebeLance(new Lance($maria,2000));

        $leilaoComLance = new Leilao('Fusca 1972 okm');
        $leilaoComLance -> recebeLance(new Lance($maria,5000));


        return [
            '2-lances' =>[2 , $leilao,[1000,2000]],
            '1 => lance' => [1, $leilaoComLance ,[5000]]
        ];
    }
}