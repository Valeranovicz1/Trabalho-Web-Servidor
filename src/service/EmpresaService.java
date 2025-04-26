package service;

import java.io.IOException;
import java.sql.Connection;
import java.sql.SQLException;

import dao.BancoDados;
import dao.EmpresaDAO;
import entities.Empresa;

public class EmpresaService {
	
	public EmpresaService() {
		
	}
	
	public void cadastrarEmpresa(Empresa empresa) throws SQLException, IOException{
		
		Connection conn = BancoDados.conectar();
		EmpresaDAO empresaDAO = new EmpresaDAO(conn);
		empresaDAO.cadastrarEmpresa(empresa);
	}
}
