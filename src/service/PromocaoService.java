package service;

import java.io.IOException;
import java.sql.Connection;
import java.sql.SQLException;

import dao.BancoDados;
import dao.PromocaoDAO;
import entities.Promocao;



public class PromocaoService {
	
	public PromocaoService() {
		
	}
	
	public void criarPromocao(Promocao promocao) throws SQLException, IOException{
		
		Connection conn = BancoDados.conectar();
		PromocaoDAO promocaoDAO = new PromocaoDAO(conn);
		promocaoDAO.criarPromocao(promocao);
		
	}
	
	public void atualizarPromocao(Promocao promocao) throws SQLException, IOException{
		
		Connection conn = BancoDados.conectar();
		PromocaoDAO promocaoDAO = new PromocaoDAO(conn);
		promocaoDAO.atualizarPromocao(promocao);
	}
	
	public void excluirPromocao(int idJogo) throws SQLException, IOException{
		
		Connection conn = BancoDados.conectar();
		PromocaoDAO promocaoDAO = new PromocaoDAO(conn);
		promocaoDAO.excluirPromocao(idJogo);
	}
}
