<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//Classe Todo
class Todo extends CI_Controller {
	/**
     * Metodo __contrutor
     * Carregar os Model necessarios para manipular essa classe
     */
    function __construct() {
        parent::__construct();
        $this->load->model('Crud', '', true);
    }

	public function index(){
		$this->load->view('todo');
	}

	/*
	 |Função salva o registro no banco de dados
	*/
	public function save(){
		//pega os dados em json e decodifica
      	$_POST = json_decode(file_get_contents("php://input"), true);

		try {
             //Testa as validações
            if (false) {

            } else {

                $tabela = 'item';
                $id = $this->input->post('id');
                $text = $this->input->post('text');
                $done = $this->input->post('done');


                $array = array('text' => $text,'done' => $done);

                //Condição para verificar se os dados foram gravados com exito
                if ($this->Crud->create($tabela, $array,false)) {
                    $data['msg'] = array('tipo' => 's', 'texto' => 'Registro gravado com Sucesso.');
                } else {
                    $data['msg'] = array('tipo' => 'e', 'texto' => 'Erro->usuario->salvar: Por favor contate o Administrador: Allan, allangcruz@gmail.com');
                }
                
            }
        } catch (Exception $exc) {
            $data['msg'] = array('tipo' => 'e', 'texto' => $exc->getMessage());
        }

        echo json_encode($data);
	}

	/*
	 |Funçao que lista os itens
	*/
	public function read(){
		try {
            $tabela = 'item';

            $ordem=array('colunadb'=>'id','tipo'=>'desc');
            $data = array();//variavel de retorno com os dados

            $resultado = $this->Crud->consultAll($tabela,"text", "",0,0,$ordem);


            foreach ($resultado as $value) {
               $lin = array();
               $lin['id'] = $value->id;
               $lin['text'] = $value->text;
               $lin['done'] = $value->done;
               $data[] = $lin ;
            }

        } catch (Exception $exc) {
            echo 'Erro Sala->controller->consultar: ' . $exc->getMessage();
        }

        echo json_encode($data);
	}

	/*
	 |
	*/
	public function update(){
		//pega os dados em json e decodifica
      	$_POST = json_decode(file_get_contents("php://input"), true);

		try {
             //Testa as validações
            if (false) {

            } else {

                $tabela = 'item';
                $id = $this->input->post('id');
                $text = $this->input->post('text');
                $done = $this->input->post('done');


                $array = array('id'=>$id, 'text' => $text,'done' => $done);

                //Condição para verificar se os dados foram gravados com exito
                if ($this->Crud->update($tabela, $array)) {
                    $data['msg'] = array('tipo' => 's', 'texto' => 'Registro atualizado com Sucesso.');
                } else {
                    $data['msg'] = array('tipo' => 'e', 'texto' => 'Erro->usuario->salvar: Por favor contate o Administrador: Allan, allangcruz@gmail.com');
                }
                
            }
        } catch (Exception $exc) {
            $data['msg'] = array('tipo' => 'e', 'texto' => $exc->getMessage());
        }

        echo json_encode($data);
	}

	/*
	 |
	*/
	public function delete($id){
		try {
            $tabela = 'item';

            if ($this->Crud->delete($tabela, $id,'id')) {
                $data['msg'] = array('tipo' => 's', 'texto' => 'Registro excluido.');
            } else {
                $data['msg'] = array('tipo' => 'e', 'texto' => 'Desculpe, mas ocorreu algum erro ao <b>excluir</b> o registro.');
            }
        } catch (Exception $exc) {
            $data['msg'] = array('tipo' => 'e', 'texto' => 'Erro ao excluir controller: <b>Usuario.</b>' . $exc->getMessage());
        }
        echo json_encode($data);
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */