package service;

import java.io.IOException;
import java.sql.Connection;
import java.sql.SQLException;
import java.util.Map;

import dao.BancoDados;
import dao.UsuarioDAO;

public class UsuarioService {
	
public UsuarioService() {
		
	}
	
    public Map<Integer, String> login(String email, String senha) throws SQLException, IOException, UsuarioNotFoundException {
    	Connection conn = BancoDados.conectar();
    	UsuarioDAO usuarioDAO = new UsuarioDAO(conn);
    	return usuarioDAO.login(email, senha);
    }
}
