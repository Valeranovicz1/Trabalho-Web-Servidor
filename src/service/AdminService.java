package service;

import java.io.IOException;
import java.sql.Connection;
import java.sql.SQLException;

import dao.AdminDAO;
import dao.BancoDados;
import entities.Admin;

public class AdminService {

	public AdminService() {
		
	}
	
	public void cadastrarAdmin(Admin admin) throws SQLException, IOException{
		
		Connection conn = BancoDados.conectar();
		AdminDAO adminDAO = new AdminDAO(conn);
		adminDAO.cadastrarAdmin(admin);
	}
}
