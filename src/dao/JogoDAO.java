package dao;

import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.ArrayList;
import java.util.List;

import entities.CategoriaEnum;
import entities.Jogo;

public class JogoDAO {
	
	private Connection conn;
	
	public JogoDAO(Connection conn){
		this.conn = conn;
	}

	public String adicionarJogo(Jogo jogo) throws SQLException{
		
		String mensagem = "Jogo cadastrado com sucesso!";
		String sql = "INSERT INTO jogo (nome, descricao, categoria, imagem, preco, classificacao, id_empresa) VALUES (?, ?, ?, ?, ?, ?, ?)";
		PreparedStatement st = null;
		
		try {
			
			st = conn.prepareStatement(sql, Statement.RETURN_GENERATED_KEYS);
			st.setString(1, jogo.getNome());
			st.setString(2, jogo.getDescricao());
			st.setString(3, jogo.getCategoria().getDescricao()); 
			st.setString(4, jogo.getImagem());
			st.setDouble(5, jogo.getPreco());
			st.setInt(6, jogo.getClassificacao());
			st.setInt(7, jogo.getIdEmpresa());

			int affectedRows = st.executeUpdate();
	        	if (affectedRows == 0) {
	        		return "Nenhum jogo foi inserido!";
	            }
			
		}catch(SQLException e) {
		
			return "Erro ao cadastrar jogo: " + e.getMessage();
		}finally {
			
			BancoDados.finalizarStatement(st);
			BancoDados.desconectar();
		}
		return mensagem;
	}
	
	
	
	public String atualizarJogo(Jogo jogo) throws SQLException {
	    
	    String mensagem = "Jogo atualizado com sucesso!";
	    String sql = "UPDATE jogo SET nome = ?, descricao = ?, categoria = ?, imagem = ?, preco = ?, classificacao = ?, id_empresa = ? WHERE id_jogo = ?";
	    PreparedStatement st = null;
	    
	    try {
	        st = conn.prepareStatement(sql);
	        st.setString(1, jogo.getNome());
	        st.setString(2, jogo.getDescricao());
	        st.setString(3, jogo.getCategoria().getDescricao()); 
	        st.setString(4, jogo.getImagem());
	        st.setDouble(5, jogo.getPreco());
	        st.setInt(6, jogo.getClassificacao());
	        st.setInt(7, jogo.getIdEmpresa());
	        st.setInt(8, jogo.getIdJogo());

	        int affectedRows = st.executeUpdate();
	        if (affectedRows == 0) {
	            return "Nenhum jogo foi atualizado!";
	        }
	        
	    } catch (SQLException e) {
	        return "Erro ao atualizar jogo: " + e.getMessage();
	    } finally {
	        BancoDados.finalizarStatement(st);
	        BancoDados.desconectar();
	    }

	    return mensagem;
	}
	
	public String excluirJogo(int idJogo) throws SQLException{
		
		String sql = "DELETE FROM jogo WHERE id_jogo = ?";
		String mensagem = "Jogo excluído com sucesso!";
		PreparedStatement st = null;
		
		try {
			
			st = conn.prepareStatement(sql);
			st.setInt(1, idJogo);
			
			int affectedRows = st.executeUpdate();
            if (affectedRows == 0) {
                return "Erro: Nenhum Jogo foi excluído!";
            }
            
            return mensagem;
            
		}catch(SQLException e) {
			return "Erro ao excluir o evento: " + e.getMessage();
			
		}finally {
			
			BancoDados.finalizarStatement(st);
			BancoDados.desconectar();
		}
	}
	
	public List<Jogo> listarJogosCategoria(String categoria) throws SQLException {
	    
		List<Jogo> lista = new ArrayList<>();
	    String sql = "SELECT nome,imagem,preco FROM jogo WHERE categoria = ?";
	    
	    PreparedStatement st = null;
	    ResultSet rs = null;

	    try {
	        st = conn.prepareStatement(sql);
	        st.setString(1, categoria);
	        rs = st.executeQuery();

	        while (rs.next()) {
	            Jogo jogo = new Jogo();
	            
	            jogo.setNome(rs.getString("nome"));
	            jogo.setImagem(rs.getString("imagem"));
	            jogo.setPreco(rs.getDouble("preco"));

	            lista.add(jogo);
	        }

	    } catch (SQLException e) {
	        e.printStackTrace();
	    } finally {
	        BancoDados.finalizarStatement(st);
	        BancoDados.finalizarResultSet(rs);
	        BancoDados.desconectar();
	    }

	    return lista;
	}
	
	
	public List<Jogo> listarJogosCompleto() throws SQLException{
		
		List<Jogo> lista = new ArrayList<>();
	    String sql = "SELECT nome,descricao, categoria,imagem,id_empresa, preco, classificacao FROM jogo";
	    
	    PreparedStatement st = null;
	    ResultSet rs = null;

	    try {
	        st = conn.prepareStatement(sql);
	        rs = st.executeQuery();

	        while (rs.next()) {
	            Jogo jogo = new Jogo();
	            
	            jogo.setNome(rs.getString("nome"));
	            jogo.setDescricao(rs.getString("descricao"));
	            jogo.setCategoria(CategoriaEnum.fromString(rs.getString("categoria")));
	            jogo.setImagem(rs.getString("imagem"));
	            jogo.setIdEmpresa(rs.getInt("id_empresa"));
	            jogo.setPreco(rs.getDouble("preco"));
	            jogo.setClassificacao(rs.getInt("classificacao"));

	            lista.add(jogo);
	        }

	    } catch (SQLException e) {
	        e.printStackTrace();
	    } finally {
	        BancoDados.finalizarStatement(st);
	        BancoDados.finalizarResultSet(rs);
	        BancoDados.desconectar();
	    }

	    return lista;
	}
	
	 public List<Jogo> listarJogosComDesconto() throws SQLException {
	        String sql = """
	            SELECT j.nome, j.imagem, 
	                   (j.preco * (1 - p.desconto / 100)) AS preco
	            FROM jogo j
	            JOIN promocao p ON j.id_jogo = p.id_jogo
	            WHERE p.duracao > CURRENT_TIMESTAMP
	        """;

	        PreparedStatement st = null;
	        ResultSet rs = null;
	        List<Jogo> jogosComDesconto = new ArrayList<>();

	        try {
	            st = conn.prepareStatement(sql);
	            rs = st.executeQuery();

	            while (rs.next()) {
	                Jogo jogo = new Jogo();
	                jogo.setNome(rs.getString("nome"));
	                jogo.setImagem(rs.getString("imagem"));
	                jogo.setPreco(rs.getDouble("preco")); 
	                
	                jogosComDesconto.add(jogo);
	            }

	        } catch (SQLException e) {
	            e.printStackTrace();
	        } finally {
	            BancoDados.finalizarStatement(st);
	            BancoDados.finalizarResultSet(rs);
	            BancoDados.desconectar();
	        }

	        return jogosComDesconto;
	    }
	 
	 public List<Jogo> listarJogosComDescontoCompleto() throws SQLException {
		
		 String sql = """
				    SELECT j.nome, j.descricao, j.categoria, j.imagem, j.preco, j.classificacao, j.id_empresa, 
				           CASE 
				               WHEN p.desconto IS NOT NULL AND p.duracao > CURRENT_TIMESTAMP THEN j.preco * (1 - p.desconto / 100)
				               ELSE j.preco 
				           END AS preco_com_desconto
				    FROM jogo j
				    LEFT JOIN promocao p ON j.id_jogo = p.id_jogo
				    WHERE p.duracao > CURRENT_TIMESTAMP OR p.id_jogo IS NULL
				""";
		 PreparedStatement st = null;
	     ResultSet rs = null;
	     List<Jogo> todosJogos = new ArrayList<>();

	        try {
	            st = conn.prepareStatement(sql);
	            rs = st.executeQuery();

	            while (rs.next()) {
	                Jogo jogo = new Jogo();
	                jogo.setNome(rs.getString("nome"));
	                jogo.setDescricao(rs.getString("descricao"));
	                jogo.setCategoria(CategoriaEnum.fromString(rs.getString("categoria"))); 
	                jogo.setImagem(rs.getString("imagem"));
	                jogo.setPreco(rs.getDouble("preco"));
	                jogo.setClassificacao(rs.getInt("classificacao"));
	                jogo.setIdEmpresa(rs.getInt("id_empresa"));

	                todosJogos.add(jogo);
	            }

	        } catch (SQLException e) {
	            e.printStackTrace();
	        } finally {
	            BancoDados.finalizarStatement(st);
	            BancoDados.finalizarResultSet(rs);
	            BancoDados.desconectar();
	        }

	        return todosJogos;
	    }
	 
}
