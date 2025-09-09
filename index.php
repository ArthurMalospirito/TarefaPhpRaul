<?php

echo "---------------ATIVIDADE 1---------------";

class Produto {

    public $nome;
    public float $preco;
    public int $estoque;

    public function __construct($nome,float $preco, int $estoque) {
        $this->nome = $nome;
        $this->preco = $preco;
        $this->estoque = $estoque;
    } 

    public function aplicarDesconto(float $percentual){

        if ($percentual<=0) {
            echo '<br>O percentual não está dentro do escopo aceito<br>';
        }
        else if ($percentual<1) {
            $this->preco*=1-$percentual;
            echo "<br> Desconto aplicado. Preço atual:$this->preco <br>";
        }
        else {
            $this->preco*=(100-$percentual)/100;
            echo "<br> Desconto aplicado. Preço atual:$this->preco <br>";
        }

    }

    public function vender(int $quantidade) {
        if ($this->estoque-$quantidade<0){
            echo "<br>Você não pode remover $quantidade produtos porque você tem apenas $this->estoque produtos<br>";
        }
        else {
            $this->estoque-=$quantidade;
            echo "<br> Estoque reduzido. Estoque atual: $this->estoque<br>";
        }
    }

    public function resumo() {
        echo "<br>-----Resumo-----<br> Nome: $this->nome <br> Preço: $this->preco <br> Estoque: $this->estoque <br>--------------------<br>";
    }


}

$veneno = new Produto('Veneno de rato',9.99,10);

$veneno->resumo();

$veneno->aplicarDesconto(5);

$veneno->vender(5);

$veneno->resumo();

echo "---------------ATIVIDADE 2---------------";

?>
