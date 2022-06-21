<?php

namespace Service;

use Alura\Leilao\Model\{Lance, Leilao, Usuario};
use Alura\Leilao\Service\Avaliador;
use PHPUnit\Framework\TestCase;

class AvaliadorTest extends TestCase
{
    public function testAvaliadorDeveEncontrarOMaiorValorDeanceEmOrdemCrescente()
    {

// Arrange - Given
        $leilao = new Leilao('Fiat 147 0KM');

        $maria = new Usuario('Maria');
        $joao = new Usuario('João');

        $leilao->recebeLance(new Lance($joao, 2000));
        $leilao->recebeLance(new Lance($maria, 2500));

        $leiloeiro = new Avaliador();

// Act - When
        $leiloeiro->avalia($leilao);

        $maiorValor = $leiloeiro->getMaiorValor();

// Assert - Then
        $valorEsperado = 2500;

        self::assertEquals(2500,$maiorValor); // fazer a comparação de direto do phpUnit, método estático

    }

    public function testAvaliadorDeveEncontrarOMaiorValorDeanceEmOrdemDecrescente()
    {

// Arrange - Given
        $leilao = new Leilao('Fiat 147 0KM');

        $maria = new Usuario('Maria');
        $joao = new Usuario('João');

        $leilao->recebeLance(new Lance($maria, 2500));
        $leilao->recebeLance(new Lance($joao, 2000));


        $leiloeiro = new Avaliador();

// Act - When
        $leiloeiro->avalia($leilao);

        $maiorValor = $leiloeiro->getMaiorValor();

// Assert - Then
        $valorEsperado = 2500;

        self::assertEquals(2500,$maiorValor); // fazer a comparação de direto do phpUnit, método estático

    }

    public function testAvaliadorDeveEncontrarOMenorValorDeanceEmOrdemDecrescente()
    {

// Arrange - Given
        $leilao = new Leilao('Fiat 147 0KM');
        $maria = new Usuario('Maria');
        $joao = new Usuario('João');
        $leilao->recebeLance(new Lance($maria, 2500));
        $leilao->recebeLance(new Lance($joao, 2000));
        $leiloeiro = new Avaliador();
        $leiloeiro->avalia($leilao);
        $menorValor = $leiloeiro->getMenorValor();
        self::assertEquals(2000,$menorValor); // fazer a comparação de direto do phpUnit, método estático

    }
    public function testAvaliadorDeveEncontrarOMenorValorDeanceEmOrdemCrescente()
    {

// Arrange - Given
        $leilao = new Leilao('Fiat 147 0KM');

        $maria = new Usuario('Maria');
        $joao = new Usuario('João');

        $leilao->recebeLance(new Lance($joao, 2000));
        $leilao->recebeLance(new Lance($maria, 2500));

        $leiloeiro = new Avaliador();

// Act - When
        $leiloeiro->avalia($leilao);

        $menorValor = $leiloeiro->getMenorValor();

// Assert - Then

        self::assertEquals(2000,$menorValor); // fazer a comparação de direto do phpUnit, método estático

    }

}