package dao;

import java.sql.Connection;
import java.io.IOException;
import java.sql.PreparedStatement;
import java.sql.SQLException;
import java.sql.Statement;

import entities.Admin;

public class AdminDAO {
    private Connection conn;

    public AdminDAO(Connection conn) {
        this.conn = conn;
    }

    public String cadastrarAdmin(Admin admin) throws SQLException, IOException{
        String sqlUsuario = "INSERT INTO usuario (nome, email, senha, tipo_usuario) VALUES (?, ?, ?, 'admin')";
        String sqlAdmin = "INSERT INTO admin (id_usuario, data_contratacao) VALUES (LAST_INSERT_ID(), ?)";
        PreparedStatement stUsuario = null;
        PreparedStatement stAdmin = null;
        
        try {
            conn.setAutoCommit(false);
            
            stUsuario = conn.prepareStatement(sqlUsuario, Statement.RETURN_GENERATED_KEYS);
            stUsuario.setString(1, admin.getNome());
            stUsuario.setString(2, admin.getEmail());
            stUsuario.setString(3, admin.getSenha());
            
            int rowsAffected = stUsuario.executeUpdate();
            if (rowsAffected == 0) {
                throw new SQLException("Erro ao cadastrar usuário!");
            }
            
            stAdmin = conn.prepareStatement(sqlAdmin);
            stAdmin.setDate(1, java.sql.Date.valueOf(admin.getDataContratacao()));
            stAdmin.executeUpdate();
            
            conn.commit();
            return "Admin cadastrado com sucesso!";
        } catch (SQLException e) {
            try {
                conn.rollback();
            } catch (SQLException ex) {
                ex.printStackTrace();
            }
            return "Erro ao cadastrar admin: " + e.getMessage();
        } finally {
            try {
                conn.setAutoCommit(true);
            } catch (SQLException ex) {
                ex.printStackTrace();
            }
            BancoDados.finalizarStatement(stAdmin);
            BancoDados.finalizarStatement(stUsuario);
            BancoDados.desconectar();
        }
    }
}
