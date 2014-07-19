<?php


/*
  | -------------------------------------------------------------------
  | Class->Model "Crud"
  | -------------------------------------------------------------------
  | Model que abstrai as funcionalidades basicas do banco de dados
  | url: ./application/model/crud.php
  | @author Allan gonçalves da cruz <allangcruz@gmail.com>
  | @version 1.0.0
  |
 */
class Crud extends CI_Model {

     /*
      | -------------------------------------------------------------------
      | Metodo "create"
      | -------------------------------------------------------------------
      | Metodo que inseri valores no banco de dados
      | @param : $table => nome da tabela.
      | @param : $array => vetor com os chave e valor
      | @param : $tipo_retorno => retorna o id ou true ou false
      | @return : retona numero de linhas afetadas
      |
     */
    public function create($table, $array,$tipo_retorno) {
        $this->db->insert($table, $array);
        if($tipo_retorno){
          return $this->db->insert_id();
        }else {
          return $this->db->affected_rows();
        }
        
    }     

     /*
      | -------------------------------------------------------------------
      | Metodo "update"
      | -------------------------------------------------------------------
      | Metodo que altera valores no banco de dados
      | @param : $table => nome da tabela.
      | @param : $array => vetor com os chave e valor, principalmente a primary key.
      | @return : retona true ou false
      |
     */    
    public function update($table, $array) {
        $this->db->where('id', $array['id']);
        $this->db->update($table, $array);
        
        if($this->db->affected_rows()>0){
            return true;
        }else{
            return false;
        }
       
    }


     /*
      | -------------------------------------------------------------------
      | Metodo "delete"
      | -------------------------------------------------------------------
      | Metodo que exclui registro no banco de dados
      | @param : $table => nome da tabela.
      | @param : $id => primary key.
      | @return : retona true ou false
      |
     */      
    public function delete($table, $id,$coluna_db) {
        $this->db->where($coluna_db, $id);
        $this->db->delete($table);
        if($this->db->affected_rows()>0){
            return true;
        }
        return false;
    }


     /*
      | -------------------------------------------------------------------
      | Metodo "read"
      | -------------------------------------------------------------------
      | Metodo que pesquisa apenas um registro
      | @param : $table => nome da tabela.
      | @param : $id => primary key.
      | @return : um vetor com os dados prenchidos
      |
     */     
    public function read($tabela, $id,$coluna_db) {
        $this->db->where($coluna_db, $id);
        $query = $this->db->get($tabela);
        return $query->result();
        }
     /*
      | -------------------------------------------------------------------
      | Metodo "consultar"
      | -------------------------------------------------------------------
      | Metodo que consulta uma lista de sala filtrando por nome
      | @param : $config=> campo que configura a ordenação da consulta enter(asc,desc)
      |
     */
    function consultAll($tabela,$coluna_db, $campo,$limite,$apartir,array $ordem) {
        $this->db->like($coluna_db, $campo);
        $this->db->order_by($ordem['colunadb'],$ordem['tipo']);          

        //teste se é para pesquisar todos, ou com limite
        if($limite)
            return $this->db->get($tabela, $limite, $apartir)->result();
        else
            return $this->db->get($tabela)->result();
    }

}

?>
