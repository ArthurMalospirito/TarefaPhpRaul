<?php

echo "<br>---------------ATIVIDADE 1---------------<br>";

class Produto {

    public string $nome;
    public float $preco;
    public int $estoque;

    public function __construct(string $nome,float $preco, int $estoque) {
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

echo "<br>---------------ATIVIDADE 2---------------<br>";

class Aluno {
    public string $nome;
    public string $matricula;
    public array $notas;

    public function __construct(string $nome,string $matricula) {
        $this->nome = $nome;
        $this->matricula = $matricula;
    }

    public function adicionarNota(float $nota) {
        $this->notas[] = $nota;
        
    }

    public function media() {
        $media = 0;
        $i = 0;
        $somaMedia =0;

        foreach ($this->notas as $nota) {
            $somaMedia +=$nota;
            $i+=1;
        }
        $media = $somaMedia/$i;
        
        return $media;

    }

    public function aprovado() {
        return $this->media()>=6;

    }

}


$aluno = new Aluno('Pedro','202510');

$aluno->adicionarNota(7);
$aluno->adicionarNota(6);
$aluno->adicionarNota(8);

echo "<br>A média é: " . $aluno->media() . "<br>";

echo "<br>O aluno foi aprovado? (1=Sim, 0=não): " . $aluno->aprovado() . "<br>";


echo "<br>---------------ATIVIDADE 3---------------<br>";

class ContaBancaria {
    public string $titular;
    public float $saldo;

    public function __construct(string $titular,float $saldo){
        $this->titular = $titular;
        $this->saldo = $saldo;
    }

    public function depositar(float $valor) {
        $this->saldo+=$valor;
        echo "<br>Saldo atual: " . $this->saldo . "<br>";
    }

    public function sacar(float $valor){
        if ($this->saldo-$valor<0){
            echo "<br> Você não tem dinheiro suficiente para sacar<br>";
        }
        else {
            $this->saldo-=$valor;
            echo "<br>Saldo atual: " . $this->saldo . "<br>";
        }
    }
    
    public function transferir(ContaBancaria $destinatario,float $valor) {
        if ($this->saldo-$valor<0){
            echo "<br> Você não tem dinheiro suficiente para transferir<br>";
        }
        else {
            $this->saldo-=$valor;
            $destinatario->saldo+=$valor;
            echo "<br>Saldo atual: " . $this->saldo . "<br>";
        }
    }


}


$conta = new ContaBancaria('Bruno',1500.00);
$conta2 = new ContaBancaria('Bruna',100);

$conta->depositar(150);
$conta->sacar(2000);
$conta->sacar(200);
$conta->transferir($conta2,150);

echo "<br>---------------ATIVIDADE 4---------------<br>";

class Biblioteca {
    public string $nome;
    public array $livros;

    public function __construct(string $nome){
        $this->nome = $nome;
    }

    public function adicionarLivro(string $titulo) {
        $this->livros[] = $titulo;
    }

    public function buscarLivro(string $termo) {
        $livrosComTermo = [];
        foreach ($this->livros as $livro) {
            if ($livro==$termo) {
                $livrosComTermo[] = $livro;
            }
        }
        var_dump($livrosComTermo);
    }

    public function listarLivros() {
        echo "<br> Listando os livros da biblioteca $this->nome <br>";
        foreach ($this->livros as $livro){
            echo "<br> $livro";
        }
        echo '<br>';
    }

}

$biblioteca = new Biblioteca('Biblioteca IF');

$biblioteca->adicionarLivro('informática');
$biblioteca->adicionarLivro('português');
$biblioteca->adicionarLivro('matemática');
$biblioteca->adicionarLivro('agronomia');

$biblioteca->buscarLivro('português');

$biblioteca->listarLivros();

echo "<br>---------------ATIVIDADE 5---------------<br>";

class Item {
    public string $nome;
    public float $preco;
    
    public function __construct(string $nome,float $preco) {
        $this->nome = $nome;
        $this->preco =$preco;
    }
}

$arroz = new Item('Arroz',24.99);
$mandioca = new Item('Mandioca',1.99);

class Pedido {

    public string $cliente;
    public $itens= [];
    private $contItens=0;

    public function __construct(string $cliente) {
        $this->cliente = $cliente;
    }

    public function adicionarItem(Item $item,int $quantidade) {

        $this->itens[0][$this->contItens] = $item;
        $this->itens[1][$this->contItens] = $quantidade;
        $this->contItens+=1;

    }

    public function total() {
        $total = 0;
        for($i=0;$i<sizeof($this->itens);$i++) {
            $total+=$this->itens[0][$i]->preco;
        }
        return $total;
    }

    public function detalhes() {
        echo "<br> ----- Detalhes do pedido -----<br>";
        echo "<br> Nome do cliente: $this->cliente <br>";
        echo "<br> Produtos: <br>";
        for ($i=0;$i<sizeof($this->itens);$i++) {
            echo "<br>-" . $this->itens[1][$i] ." ". $this->itens[0][$i]->nome;
        }
        echo "<br>";
        echo "<br>Total: " . $this->total();

    }

}

$pedido = new Pedido('Jonas');

$pedido->adicionarItem($arroz,2);
$pedido->adicionarItem($mandioca,5);

echo "O total é: <br>".$pedido->total()."<br>";

$pedido->detalhes();


echo "<br>---------------ATIVIDADE 6---------------<br>";

class Turma {

    public string $disciplina;
    public array $alunos;

    public function __construct(string $disciplina){
        $this->disciplina = $disciplina;
    }

    public function adicionarAluno(Aluno $aluno) {
        $this->alunos[] = $aluno;
    }

    public function melhorAluno() {
        $melhorAluno = $this->alunos[0];

        foreach ($this->alunos as $aluno) {

            if ($aluno->media()>$melhorAluno->media()) {
                $melhorAluno=$aluno;
            }
            
        }
        return $melhorAluno;
    }

    public function resultadoFinal() {
        echo "<br>---Resultado Final---<br>";

        foreach ($this->alunos as $aluno) {
            echo "<br>O aluno $aluno->nome foi aprovado? (1=Sim, 0=não): " . $aluno->aprovado();
        }

    }

}

$aluno2 = new Aluno('Jonas','202509');
$aluno3 = new Aluno('Marcos','202508');

$aluno2->adicionarNota(5);
$aluno2->adicionarNota(7);
$aluno2->adicionarNota(10);

$aluno3->adicionarNota(2);
$aluno3->adicionarNota(10);
$aluno3->adicionarNota(10);

$turma  = new Turma('Matemática');

$turma->adicionarAluno($aluno);
$turma->adicionarAluno($aluno2);
$turma->adicionarAluno($aluno3);

echo "O melhor aluno da turma é: " . $turma->melhorAluno()->nome;

$turma->resultadoFinal();

echo "<br>---------------ATIVIDADE 7---------------<br>";

class Agenda {

    public array $contatos;

    public function adicionarContato(string $nome,string $telefone) {
        $this->contatos[$nome] = $telefone;
    }

    public function removerContato(string $nome) {
        $this->contatos[$nome] = NULL;
    }

    public function buscarContato(string $nome) {
        if (!empty($this->contatos[$nome])) {
            echo "<br>Telefone do contato $nome é ".$this->contatos[$nome];
        }
        else {
            echo "<br>Essse contato '$nome' não existe";
        }
    }

    public function listarContatos() {
        echo "<br> ---Listando contatos---<br>";
        foreach ($this->contatos as $nome => $telefone) {
            echo "<br> $nome - $telefone";
        }
    }

}

$agenda = new Agenda;

$agenda->adicionarContato('paulo','123');
$agenda->adicionarContato('pedro','321');
$agenda->adicionarContato('pedra','543');

$agenda->buscarContato('paulo');
$agenda->buscarContato('prima');

$agenda->listarContatos();

?>
