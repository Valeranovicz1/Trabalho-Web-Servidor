package dao;

import java.io.IOException;
import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.HashMap;
import java.util.Map;

import service.UsuarioNotFoundException;

public class UsuarioDAO {
	
	 private Connection conn;

	    public UsuarioDAO(Connection conn) {
	        this.conn = conn;
	    }

	    public Map<Integer, String> login(String email, String senha) throws SQLException, IOException, UsuarioNotFoundException {
	        Map<Integer, String> resultado = new HashMap<>();
	        String sql = "SELECT id, tipo_usuario FROM usuario WHERE email = ? AND senha = ?";
	        conn = BancoDados.conectar();
	        PreparedStatement stmt = null;
	        try {
	            stmt = conn.prepareStatement(sql);
	            stmt.setString(1, email);
	            stmt.setString(2, senha);
	            
	            try (ResultSet rs = stmt.executeQuery()) {
	                if (rs.next()) {
	                    int userId = rs.getInt("id");
	                    String tipoUsuario = rs.getString("tipo_usuario");
	                    resultado.put(userId, tipoUsuario);
	                    return resultado;
	                }
	            }
	        } catch (SQLException e){
	        	System.out.println("Erro ao conectar-se ao banco de dados: " + e.getMessage());
	        } finally {
	            BancoDados.finalizarStatement(stmt);
	            BancoDados.desconectar();
	        }
	        
	        throw new UsuarioNotFoundException("Usuario ou senha incorretos, tente novamente");
	    }
}
