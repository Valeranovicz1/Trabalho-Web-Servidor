package service;

import java.io.IOException;
import java.sql.Connection;
import java.sql.SQLException;
import java.util.List;

import dao.BancoDados;
import dao.JogoDAO;
import entities.Jogo;

public class JogoService {
	
	public JogoService() {
		
	}
	
	public void adicionarJogo(Jogo jogo) throws SQLException, IOException{
		
		Connection conn = BancoDados.conectar();
		JogoDAO jogoDAO = new JogoDAO(conn);
		jogoDAO.adicionarJogo(jogo);
		
	}
		
	public List<Jogo> listarJogoCategoria(String categoria) throws SQLException, IOException{
		
		Connection conn = BancoDados.conectar();
		List<Jogo> jogos = new JogoDAO(conn).listarJogosCategoria(categoria);
		return jogos;
	}
	
	public List<Jogo> listarJogoCompleto() throws SQLException, IOException{
		
		Connection conn = BancoDados.conectar();
		List<Jogo> jogosCompleto = new JogoDAO(conn).listarJogosCompleto();
		return jogosCompleto;
	}
	
	public List<Jogo> listarJogosComDesconto() throws SQLException, IOException{
		
		Connection conn = BancoDados.conectar();
		List<Jogo> jogosDesconto = new JogoDAO(conn).listarJogosComDesconto();
		return jogosDesconto;
	}
	
	public List<Jogo> listarJogosComDescontoCompleto() throws SQLException, IOException{
		
		Connection conn = BancoDados.conectar();
		List<Jogo> jogosDescCompleto = new JogoDAO(conn).listarJogosComDescontoCompleto();
		return jogosDescCompleto;
	}
	
	public void excluirJogo(int idJogo) throws SQLException, IOException{
		
		Connection conn = BancoDados.conectar();
		JogoDAO jogoDAO = new JogoDAO(conn);
		jogoDAO.excluirJogo(idJogo);
		
	}
}
