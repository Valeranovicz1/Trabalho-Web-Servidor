package dao;

import java.io.IOException;
import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.SQLException;
import java.sql.Statement;

import entities.Empresa;

public class EmpresaDAO {
	
	private Connection conn;
	
	public EmpresaDAO(Connection conn) {
		
		this.conn = conn;
	}
	
	public String cadastrarEmpresa(Empresa empresa) throws SQLException, IOException {
        String sqlUsuario = "INSERT INTO usuario (nome_completo, email, senha, tipo_usuario) VALUES (?, ?, ?, 'empresa')";
        String sqlEmpresa = "INSERT INTO empresa (id_usuario,site) VALUES (LAST_INSERT_ID(), ?)";
        PreparedStatement stUsuario = null;
        PreparedStatement stEmpresa = null;
        
        try {
            conn.setAutoCommit(false);

            stUsuario = conn.prepareStatement(sqlUsuario, Statement.RETURN_GENERATED_KEYS);
            stUsuario.setString(1, empresa.getNome());
            stUsuario.setString(2, empresa.getEmail());
            stUsuario.setString(3, empresa.getSenha());
            
            int rowsAffected = stUsuario.executeUpdate();
            if (rowsAffected == 0) {
                throw new SQLException("Erro ao cadastrar usuário!");
            }
            
            stEmpresa = conn.prepareStatement(sqlEmpresa);
            stEmpresa.setString(1, empresa.getSite());
            stEmpresa.executeUpdate();
            
            conn.commit();
            return "Empresa cadastrado com sucesso!";
            
        } catch (SQLException e) {
            try {
                conn.rollback();
            } catch (SQLException ex) {
                ex.printStackTrace();
            }
            return "Erro ao cadastrar Empresa: " + e.getMessage();
            
        } finally {
            try {
                conn.setAutoCommit(true);
            } catch (SQLException ex) {
                ex.printStackTrace();
            }
            BancoDados.finalizarStatement(stEmpresa);
            BancoDados.finalizarStatement(stUsuario);
            BancoDados.desconectar();
        }
    }
}
