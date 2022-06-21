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

    public function testeAvaliadorDeveBuscar3MaioresValores()
    {
        $leilao = new Leilao('Fiat 147 0Km');
        $joao = new Usuario('Joao');
        $maria = new Usuario("Maria");
        $ana = new Usuario("Ana");
        $jorge = new Usuario(('jorge'));

        $leilao -> recebeLance(new Lance($ana,1500));
        $leilao -> recebeLance(new Lance($joao , 1000));
        $leilao -> recebeLance(new  Lance ($maria,2000));
        $leilao -> recebeLance(new  Lance ($jorge,1700));

        $leiloeiro = new Avaliador();
        $leiloeiro->avalia($leilao);

        $maiores = $leiloeiro->getMaioresLances();
        static::assertCount(3, $maiores);
        static::assertEquals(2000, $maiores[0]->getValor());
        static::assertEquals(1700, $maiores[1]->getValor());
        static::assertEquals(1500, $maiores[2]->getValor());


    }
}