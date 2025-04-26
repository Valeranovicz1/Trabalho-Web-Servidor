package dao;

import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.time.LocalDate;
import java.util.ArrayList;
import java.util.List;

import entities.Jogo;

public class ListaDesejosDAO {
	
	private Connection conn;
	
	public ListaDesejosDAO(Connection conn){
		this.conn = conn;
	}
	
	public void adicionarJogoListaDesejos(int idCliente, int idJogo) throws SQLException {
		
        String sql = "INSERT INTO lista_desejos (id_cliente, id_jogo, data_adicionado) VALUES (?, ?, ?)";
        PreparedStatement st = conn.prepareStatement(sql);
        st.setInt(1, idCliente);
        st.setInt(2, idJogo);
        st.setDate(3, java.sql.Date.valueOf(LocalDate.now()));
        st.executeUpdate();
    }

    public void removerJogoListaDesejos(int idCliente, int idJogo) throws SQLException {
       
        String sql = "DELETE FROM lista_desejos WHERE id_cliente = ? AND id_jogo = ?";
        PreparedStatement st = conn.prepareStatement(sql);
        st.setInt(1, idCliente);
        st.setInt(2, idJogo);
        st.executeUpdate();
    }

    public List<Jogo> listarJogosDesejados(int idCliente) throws SQLException {
        
    	String sql = "SELECT j.* FROM jogo j JOIN lista_desejos ld ON j.id_jogo = ld.id_jogo WHERE ld.id_cliente = ?";
    	PreparedStatement st = null;
    	ResultSet rs = null;
    	List<Jogo> jogosDesejados = new ArrayList<Jogo>();
    	try {
            
    		st = conn.prepareStatement(sql);
            st.setInt(1, idCliente);
            rs = st.executeQuery();

            while (rs.next()) {
                Jogo jogo = new Jogo();
                jogo.setIdJogo(rs.getInt("id_jogo"));
                jogo.setNome(rs.getString("nome"));
                jogo.setImagem(rs.getString("imagem"));
                jogo.setPreco(rs.getDouble("preco"));
                
                jogosDesejados.add(jogo);
            }
    	}catch(SQLException e) {
    		System.out.println("Erro ao buscar jogos desejados! "  + e.getMessage());
    	}finally {
    		BancoDados.finalizarResultSet(rs);
    		BancoDados.finalizarStatement(st);
    		BancoDados.desconectar();
    	}
        
        return jogosDesejados;
    }
}
