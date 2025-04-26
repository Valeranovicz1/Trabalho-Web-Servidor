package service;

import java.io.IOException;
import java.sql.Connection;
import java.sql.SQLException;

import dao.BancoDados;
import dao.ClienteDAO;
import entities.Cliente;

public class ClienteService {
	
	public ClienteService() {
		
	}
	
	public void cadastrarCliente(Cliente cliente) throws SQLException, IOException {
		
		Connection conn = BancoDados.conectar();
		ClienteDAO clienteDAO = new ClienteDAO(conn);
		clienteDAO.cadastrarCliente(cliente);
	}
	
	public void adicionarFundos(int idCliente, Double valor) throws SQLException, IOException{
		
		Connection conn = BancoDados.conectar();
		ClienteDAO clienteDAO = new ClienteDAO(conn);
		clienteDAO.adicionarFundos(idCliente, valor);
		
	}
}
