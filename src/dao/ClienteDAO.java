package dao;

import java.io.IOException;
import java.sql.*;
import entities.Cliente;

public class ClienteDAO {
    private Connection conn;

    public ClienteDAO(Connection conn) {
        this.conn = conn;
    }

    public String cadastrarCliente(Cliente cliente) throws SQLException, IOException {
        String sqlUsuario = "INSERT INTO usuario (nome_completo, email, senha, tipo_usuario) VALUES (?, ?, ?, 'cliente')";
        String sqlCliente = "INSERT INTO cliente (id_usuario, nickname, data_nascimento) VALUES (LAST_INSERT_ID(),?, ?)";
        PreparedStatement stUsuario = null;
        PreparedStatement stCliente = null;
        
        try {
            conn.setAutoCommit(false);

            stUsuario = conn.prepareStatement(sqlUsuario, Statement.RETURN_GENERATED_KEYS);
            stUsuario.setString(1, cliente.getNome());
            stUsuario.setString(2, cliente.getEmail());
            stUsuario.setString(3, cliente.getSenha());
            
            int rowsAffected = stUsuario.executeUpdate();
            if (rowsAffected == 0) {
                throw new SQLException("Erro ao cadastrar usuário!");
            }
            
            stCliente = conn.prepareStatement(sqlCliente);
            stCliente.setString(1, cliente.getNickname());
            stCliente.setDate(2, java.sql.Date.valueOf(cliente.getDataNascimento()));
            stCliente.executeUpdate();
            
            conn.commit();
            return "Cliente cadastrado com sucesso!";
            
        } catch (SQLException e) {
            try {
                conn.rollback();
            } catch (SQLException ex) {
                ex.printStackTrace();
            }
            return "Erro ao cadastrar cliente: " + e.getMessage();
            
        } finally {
            try {
                conn.setAutoCommit(true);
            } catch (SQLException ex) {
                ex.printStackTrace();
            }
            BancoDados.finalizarStatement(stCliente);
            BancoDados.finalizarStatement(stUsuario);
            BancoDados.desconectar();
        }
    }
    
    public String adicionarFundos(int idCliente, double valor) throws SQLException{
    	
    	String sql = "UPDATE cliente SET carteira = carteira + ? WHERE id_cliente = ?";
    	String mensagem = "Fundos adicionados com sucesso!";
    	PreparedStatement st = null;
    	
    	try {
    		
    		st = conn.prepareStatement(sql);
    		st.setDouble(1, valor);
    		st.setInt(2, idCliente);
    		st.executeUpdate();
    		
    	}catch(SQLException e) {
    		return "Erro ao adicionar fundos.";
    	}finally {
    		BancoDados.finalizarStatement(st);
    		BancoDados.desconectar();
    	}
    	return mensagem;
    }
}
