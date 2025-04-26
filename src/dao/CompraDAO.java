package dao;

import java.sql.Connection;
import java.sql.Date;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.time.LocalDate;
import java.util.ArrayList;
import java.util.List;

import entities.Compra;
import entities.Jogo;

public class CompraDAO {
	
	private Connection conn;
	
	public CompraDAO(Connection conn){
		this.conn = conn;
	}
	
	public void realizarCompraCompleta(int idCliente, List<Jogo> carrinho) throws SQLException {
	    if (carrinho == null || carrinho.isEmpty()) {
	        throw new IllegalArgumentException("Carrinho está vazio.");
	    }

	    String insertCompraSQL = "INSERT INTO compra (id_cliente, data_compra, valor_total) VALUES (?, ?, ?)";
	    String insertCompraJogoSQL = "INSERT INTO compra_jogo (id_compra, id_jogo) VALUES (?, ?)";

	    double valorTotal = 0.0;
	    for (Jogo jogo : carrinho) {
	        valorTotal += jogo.getPreco();
	    }

	    PreparedStatement stCompra = null;
	    ResultSet rsKeys = null;
	    PreparedStatement stCompraJogo = null;

	    try {
	        conn.setAutoCommit(false);

	        stCompra = conn.prepareStatement(insertCompraSQL, PreparedStatement.RETURN_GENERATED_KEYS);
	        stCompra.setInt(1, idCliente);
	        stCompra.setDate(2, Date.valueOf(LocalDate.now()));
	        stCompra.setDouble(3, valorTotal);
	        stCompra.executeUpdate();

	        rsKeys = stCompra.getGeneratedKeys();
	        int idCompra = 0;
	        if (rsKeys.next()) {
	            idCompra = rsKeys.getInt(1);
	        }

	        stCompraJogo = conn.prepareStatement(insertCompraJogoSQL);
	        for (Jogo jogo : carrinho) {
	            stCompraJogo.setInt(1, idCompra);
	            stCompraJogo.setInt(2, jogo.getIdJogo());
	            stCompraJogo.addBatch();
	        }
	        stCompraJogo.executeBatch();

	        conn.commit(); 
	        System.out.println("Compra realizada com sucesso!");

	    } catch (SQLException e) {
	        conn.rollback();
	        throw e;
	    } finally {
	        if (rsKeys != null) rsKeys.close();
	        if (stCompra != null) stCompra.close();
	        if (stCompraJogo != null) stCompraJogo.close();
	        conn.setAutoCommit(true);
	    }
	}
	
	
	public void realizarCompra(int idCliente) throws SQLException{
		
		String sqlCompra = "INSERT INTO compra (id_cliente, data_compra, valor_total) VALUES (?, ?, ?)";
		String sqlCompraJogo = "INSERT INTO compra_jogo (id_compra, id_jogo) VALUES (?,?)";
		PreparedStatement st = null;
		
		try {
			
		}catch(SQLException e) {
			System.out.println("foda");
		}finally {
			
			BancoDados.finalizarStatement(st);
			BancoDados.desconectar();
		}
	}
}