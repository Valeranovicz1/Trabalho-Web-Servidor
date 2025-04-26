package service;

import java.io.IOException;
import java.sql.Connection;
import java.sql.SQLException;
import java.util.List;

import dao.BancoDados;
import dao.ListaDesejosDAO;
import entities.Jogo;

public class ListaDesejoService {

	public ListaDesejoService() {
		
	}
	
	public void adicionarJogoListaDesejos(int idCliente, int idJogo) throws SQLException, IOException {
		
		Connection conn = BancoDados.conectar();
		ListaDesejosDAO listaDesejosDAO = new ListaDesejosDAO(conn);
		listaDesejosDAO.adicionarJogoListaDesejos(0, 0);
	}
	
	public void retirarJogoDesejado(int idCliente, int idJogo) throws SQLException, IOException {
		
		Connection conn = BancoDados.conectar();
		ListaDesejosDAO listaDesejosDAO = new ListaDesejosDAO(conn);
		listaDesejosDAO.removerJogoListaDesejos(idCliente, idJogo);
		
	}
	
	public List<Jogo> listarJogosDesejados(int idCliente) throws SQLException, IOException {
		
		Connection conn = BancoDados.conectar();
		List<Jogo> jogosDesejados = new ListaDesejosDAO(conn).listarJogosDesejados(idCliente);
		
		return jogosDesejados;
	}
}
