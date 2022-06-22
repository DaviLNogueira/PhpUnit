<?php

namespace Service;

use Alura\Leilao\Model\{Lance, Leilao, Usuario};
use Alura\Leilao\Service\Avaliador;
use PHPUnit\Framework\TestCase;

class AvaliadorTest extends TestCase
{

    protected function setUp(): void //qualquer chamada de função irá fazer o que está nessa função

    {
        echo "Executando";
        $this -> leiloeiro = new Avaliador();
    }

    /**
     * @dataProvider leiaoEmOrdemAleatorio
     * @dataProvider leiaoEmOrdemDescrescente
     * @dataProvider leiaoEmOrdemCrescente
     *
     */

    public function testAvaliadorDeveEncontrarOMenorValorDeanceEmOrdemCrescente(Leilao $leilao)
    {

// Arrange - Given




// Act - When
       $this->leiloeiro->avalia($leilao);

        $menorValor = $this->leiloeiro->getMenorValor();

// Assert - Then

        self::assertEquals(1700,$menorValor); // fazer a comparação de direto do phpUnit, método estático

    }

    public function testeAvaliadorDeveBuscar3MaioresValores()
    {
        $leilao = new Leilao('Fiat 147 OKm');

        $joao = new Usuario('Joao');
        $maria = new Usuario("Maria");
        $ana = new Usuario("Ana");
        $jorge = new Usuario(('jorge'));

        $leilao -> recebeLance(new Lance($ana,1500));
        $leilao -> recebeLance(new Lance($joao , 1000));
        $leilao -> recebeLance(new  Lance ($maria,2000));
        $leilao -> recebeLance(new  Lance ($jorge,1700));


        $this->leiloeiro->avalia($leilao);

        $maiores = $this->leiloeiro->getMaioresLances();
        static::assertCount(3, $maiores);
        static::assertEquals(2000, $maiores[0]->getValor());
        static::assertEquals(1700, $maiores[1]->getValor());
        static::assertEquals(1500, $maiores[2]->getValor());


    }

    public function leiaoEmOrdemCrescente(): array
    {
        $leilao = new Leilao('Fiat 147 OKm');

        $joao = new Usuario('Joao');
        $maria = new Usuario("Maria");
        $ana = new Usuario("Ana");

        $leilao -> recebeLance(new Lance($ana,1700));
        $leilao -> recebeLance(new Lance($joao , 2000));
        $leilao -> recebeLance(new  Lance ($maria,2500));

        return [ 'ordem-crescente' => [$leilao]];
    }

    public function leiaoEmOrdemDescrescente(): array
    {
        $leilao = new Leilao('Fiat 147 OKm');

        $joao = new Usuario('Joao');
        $maria = new Usuario("Maria");
        $ana = new Usuario("Ana");

        $leilao -> recebeLance(new  Lance ($maria,2500));
        $leilao -> recebeLance(new Lance($joao , 2000));
        $leilao -> recebeLance(new Lance($ana,1700));


        return ['ordem -decrescente' => [$leilao]];

    }

    public function leiaoEmOrdemAleatorio(): array
    {
        $leilao = new Leilao('Fiat 147 OKm');

        $joao = new Usuario('Joao');
        $maria = new Usuario("Maria");
        $ana = new Usuario("Ana");

        $leilao -> recebeLance(new  Lance ($maria,2500));
        $leilao -> recebeLance(new Lance($ana,1700));
        $leilao -> recebeLance(new Lance($joao , 2000));



        return [
            'ordem-aleatoria' => [$leilao]];
    }

    public function testLeilaoVazioNaoPodeSerAvaliado(){

            $this -> expectException(\DomainException::class);
            $this -> expectExceptionMessage('Não é possivel analisar teste vazio');
            $leilao = new Leilao('Fusca Azual');
            $this -> leiloeiro -> avalia($leilao);



    }



}